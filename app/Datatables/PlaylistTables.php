<?php
namespace App\Datatables;

use App\Models\Playlist;
use App\Modules\Datatables\Services\DatatablesService;

class PlaylistTables extends DatatablesService{

    public function query()
    {
        $query = Playlist::query();
        return $query->orderBy('broadcast_date', 'asc');
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
            'data' => 'broadcast_date',
            'name' => 'broadcast_date',
            'title' => 'Broadcast Date',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-medium'
        ]);

        $this->addColumn([
            'data' => 'broadcast_on',
            'name' => 'broadcast_on',
            'title' => 'Broadcast On',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-medium'
        ]);

        $this->addColumn([
            'data' => 'customer_id',
            'name' => 'customer_id',
            'title' => 'Customer',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-medium',
            'render' => function($value){
                return $value->customer->name;
            },
        ]);

        $this->addColumn([
            'data' => 'status',
            'name' => 'status',
            'title' => 'Status',
            'class' => 'text-center dt-id',
            'raw' => true,
            'render' => function($value){
                if($value->audio->count() > 0){
                    switch ($value->status){
                        case Playlist::PLAYLIST_STATUS_PENDING:
                            return '<a href="'.route('dashboard.make.playlist',['id' => $value->id]).'" class="btn btn-primary">Make Stream</a>';
                            break;
                        case Playlist::PLAYLIST_STATUS_COMPLETED:
                            return '<button class="btn btn-primary">Ready</button>';
                            break;
                        default:
                            return '<button class="btn btn-primary">Processing</button>';
                    }
                }else{
                    return "Empty Playlist";
                }
            },
        ]);


    }
}