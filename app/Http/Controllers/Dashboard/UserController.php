<?php

namespace App\Http\Controllers\Dashboard;

use App\Datatables\RoleData;
use App\Datatables\UserDatatables;
use App\Helpers\Services\Datatables\RoleDatatables;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class UserController extends Controller{
    public function index(UserDatatables $datatables){
        return $datatables->render("dashboard.pages.users.index");
    }

    public function edit($id){

    }

    public function update($id, Request $request){

        return redirect()->back();
    }

    public function store(Request $request){

    }

    public function delete(){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                Role::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}