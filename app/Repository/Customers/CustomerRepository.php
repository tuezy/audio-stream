<?php
namespace App\Repository\Customers;

use App\Helpers\Repository\Repository;
use App\Models\Customer;

class CustomerRepository extends Repository implements CustomerRepositoryContract {

    public function model(): string
    {
        return Customer::class;
    }


}
