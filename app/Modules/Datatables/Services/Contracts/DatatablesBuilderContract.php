<?php
namespace App\Modules\Datatables\Services\Contracts;
interface DatatablesBuilderContract{
    public function columns(): array;
    public function addColumn(array $column);
    public function prepareQuery();
}