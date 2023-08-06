<?php

namespace App\Events;

use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CreateCustomerStreamChannel implements ShouldQueue
{
    use Dispatchable,  SerializesModels;

    protected $customer;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function handle(){
        File::ensureDirectoryExists(live_path($this->customer->id), 0777, 1);
    }


}
