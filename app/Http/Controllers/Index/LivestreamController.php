<?php

namespace App\Http\Controllers\Index;

use App\Repository\Customers\CustomerRepositoryContract;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class LivestreamController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $customerRepository;

    public function __construct(CustomerRepositoryContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(){
        $customers = $this->customerRepository->where("isLive", "=", true)->get();

        return view("index.pages.livestream.index", [
            'customers' => $customers
        ]);
    }

    public function channel($channel){
        $customers = $this->customerRepository->where("live_channel", "=", $channel)->firstOrFail();
        dd($customers);
    }
}
