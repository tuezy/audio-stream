<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;

use App\Repository\Customers\CustomerRepositoryContract;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class LiveController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $customerRepository;

    public function __construct(CustomerRepositoryContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function enableCustomerChannel(Request $request){
        $customer= $this->customerRepository
            ->where("live_channel", "=", $request->get("live_channel"));
        if($request->has("disable_livestream")){
            $customer= $customer->where("isLive", "=", true)->where("live_channel", "=", $request->get("live_channel"))->where("email", "=", $request->get("disable_livestream"))->first();
        }

        if($request->has("enable_livestream")){
            $customer= $customer->where("isLive", "=", false)->where("live_key", "=", "")->where("email", "=", $request->get("enable_livestream"))->first();
        }

        if($customer->id > 0){
            $customer->isLive = !$customer->isLive;
            $customer->live_key = $customer->isLive ? md5(time() . $customer->email) : "";

            $customer->use_default_channel = $request->has("use_default_channel") ?? false;
            if($customer->use_default_channel){
                $customer->live_key = "";
            }
        }

        $customer->save();

        if($request->has("disable_livestream")) {
            Artisan::call("remove:channel " . $customer->live_channel);
        }

        if($request->has("enable_livestream")) {
            Artisan::call("new:channel " . $customer->live_channel);
        }

        return back()->with("success", "Thành công");
    }

    public function live(){
        $request = request();

        Log::debug(json_encode(request()->all()));
        if($request->has("call")){

            $swfurl = $request->has("swfurl") ? $request->get("swfurl") : '';
            $tcurl = $request->has("tcurl") ? $request->get("tcurl") : '';

            if($swfurl){
                $url = $swfurl;
            }

            if($tcurl){
                $url = $tcurl;
            }

            $query = parse_url($url, PHP_URL_QUERY);

            $userChannel = Str::substr($query, strpos($query,"=") + 1, strlen($query));

            Log::debug($query . "-" . $userChannel );

            if($request->has("name") && !is_null($request->get("name"))){
                $customer = Customer::where("live_key", "=", $request->get('name'))
                    ->where("live_channel", "=", $userChannel)
                    ->firstOrFail();
            }else{

            }

            if($request->get("call") == 'publish'){
                return $customer->isLive;
            }

            if($request->get("call") == 'done'){
                $customer->isLive = false;
            }

            $customer->save();
        }

        return true;
    }

    public function publish(Request $request){
        if($request->has('app')){
            $channel = str_replace("livestream-", "", $request->get("app"));
        }

        if($request->has('name')){
            $name = $request->get("name");
        }



        $customerByChannel = Customer::where("live_channel", "=", $channel)
            ->where("isLive", "=", true)->firstOrFail();

        $allChannels = (new Finder())->in(storage_path("live-stream"))->files()->name("index.m3u8");

        if($allChannels->count() > 0){
            foreach ($allChannels as $stt => $channel){
                $epl = explode("/", $channel->getRelativePathname());
                if($epl[0] == $customerByChannel->live_channel){
                    abort(503);
                }
            }
        }
        if($customerByChannel->use_default_channel){
            return true;
        }

        if($customerByChannel->live_key == $name){
            return true;
        }

        abort(404);

    }

    public function update(){
        Log::debug(__FUNCTION__ . json_encode(request()->all()));
    }
    public function done_livestream(Request $request){
        if($request->has('app')){
            $channel = str_replace("livestream-", "", $request->get("app"));
        }
        if($request->has('name')){
            $name = $request->get("name");
        }
        $customerByChannel = Customer::where("live_channel", "=", $channel)
            ->where("isLive", "=", true)->firstOrFail();

    }

}
