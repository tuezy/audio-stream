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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LiveController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $customerRepository;

    public function __construct(CustomerRepositoryContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function enable(Request $request){
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
        Artisan::call("remove:channel ".$customer->live_channel);

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

    public function publish(){
        Log::debug(__FUNCTION__ . json_encode(request()->all()));
    }

    public function update(){
        if(!File::exists(storage_path(request()->get("app")))){
            throw new \Exception("Stop Customer Livestream");
        }
    }
    public function done_livestream(){
        Log::debug(__FUNCTION__ . json_encode(request()->all()));
    }

}
