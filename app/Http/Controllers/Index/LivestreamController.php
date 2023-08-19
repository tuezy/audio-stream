<?php

namespace App\Http\Controllers\Index;

use App\Repository\Customers\CustomerRepositoryContract;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;

class LivestreamController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $customerRepository;

    public function __construct(CustomerRepositoryContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(){
        $customers = [];

        $allChannels = (new Finder())->in(storage_path("live-stream"))->files()->name("index.m3u8");

        if($allChannels->count()){
            foreach ($allChannels as $stt => $channel){
                $epl = explode("/", $channel->getRelativePathname());
                $customers[$stt]['channel'] = $epl[0];
                $customers[$stt]['path'] = $channel->getRelativePathname();
                $customers[$stt]['key'] = $epl[1] != 'index.m3u8' ? $epl[1] : null;
            }
        }
        return view("index.pages.livestream.index", [
            'customers' => $customers
        ]);
    }

    public function channel($channel){
        $customer = $this->customerRepository->where("live_channel", "=", $channel)->first();

        if(isset($customer->id)){
            return view("index.pages.livestream.customer-onair", [
                'customer' => $customer
            ]);
        }

        if(File::exists($dir = storage_path("live-stream/".$channel))){
            $finder = (new Finder())->in($dir)->files()->name("index.m3u8");
            if($finder->count() > 0){
                foreach($finder as $file){
                    return view("index.pages.livestream.customer-onair-byfile", [
                        'file' => $file->getRelativePathname(),
                        'channel' => $channel
                    ]);
                }
            }
        }

        abort(404);
    }
}
