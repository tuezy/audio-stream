<?php
namespace App\Modules\Datatables\Services\Contracts;
interface DatatablesHelperContract{
    public function columns();
    public function addColumn(array $column);
    public function prepareQuery();
}