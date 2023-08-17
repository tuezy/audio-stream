<?php
namespace App\Repository\Customers;

use App\Helpers\Repository\RepositoryCache;
use App\Repository\Customers\CustomerRepository;
use App\Repository\Customers\CustomerRepositoryContract;

class CustomerRepositoryCache extends RepositoryCache implements CustomerRepositoryContract {

    public function repository(): string
    {
        return CustomerRepository::class;
    }
}
