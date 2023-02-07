<?php

namespace App\Http\Controllers\Dashboard;

use App\Datatables\CmsDatatables;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Role;
use Illuminate\Http\Request;

class CmsController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CmsDatatables $datatables){
        return $datatables->render("dashboard.pages.cms.index");
    }

    public function edit($id){

        $item = Cms::findOrFail($id);

        return view("dashboard.pages.cms.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){

        return redirect()->back();
    }
    public function create(){
        return view("dashboard.pages.cms.create");
    }
    public function store(Request $request){

    }

    public function delete(){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                Cms::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}