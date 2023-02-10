<?php
namespace App\Datatables;

use App\Models\Cms;
use App\Modules\Datatables\Services\DatatablesService;

class CmsDatatables extends DatatablesService{

    public function query()
    {
        $query = Cms::query();
        return $query->orderBy('id', 'desc');
    }

    public function columns()
    {
        $this->addColumn([
            'data' => 'checkbox',
            'class' => 'text-center dt-id',
            'searchable' => false,
            'orderable' => false,
            'title' => '<div class="form-check text-center">
                                <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                            </div>',
            'render' => function($value){
                return '<div class="custom-control custom-checkbox text-center">
                        <input type="checkbox" name="chk_child" value="'.$value->id.'" class="dataTable-checkbox">
                        </div>';
            },
            'raw' => true
        ]);
//        $this->addColumn([
//            'data' => 'index',
//            'name' => 'index',
//            'title' => 'Index',
//            'searchable' => false,
//            'orderable' => false,
//            'exportable' => false,
//            'printable' => false,
//            'render' => function($value){
//                return '<div class="custom-control custom-checkbox text-center">
//                        <input type="text" name="index" value="'.$value->index.'" class="form-control">
//                        </div>';
//            },
//            'class' => 'text-center dt-id',
//            'raw' => true
//        ]);

        $this->addColumn([
            'data' => 'id',
            'name' => 'id',
            'title' => 'Id',
            'searchable' => false,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'text-center dt-id'
        ]);
        $this->addColumn([
            'data' => 'title',
            'name' => 'title',
            'title' => 'Title',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
        ]);

        $this->addColumn([
            'data' => 'visibility',
            'name' => 'visibility',
            'title' => 'Visibility',
            'class' => 'text-center dt-id',
            'raw' => true,
            'render' => function($value){
                return $value->visibility == 0 ? '<span class="badge badge-soft-danger text-uppercase">Hidden</span>' : '<span class="badge badge-soft-success text-uppercase">Show</span>';
            },
        ]);

        $this->addColumn([
            'data' => 'created_at',
            'name' => 'created_at',
            'title' => 'Created at',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date',
            'render' => function($value){
                return date('d-m-Y', strtotime($value->created_at));
            },
        ]);



        $this->addColumn([
            'data' => 'action',
            'class' => 'text-center dt-id',
            'title' => 'Action',
            'raw' => true,
            'render' => function($value){
                return view('dashboard.pages.cms.partials.action', ['value' => $value]);
            },
        ]);
    }
}