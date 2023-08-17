<?php

namespace App\Http\Controllers\Dashboard;

use App\Datatables\RoleData;
use App\Helpers\Services\Datatables\RoleDatatables;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class RoleController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(RoleData $datatables){
        return $datatables->render("dashboard.pages.roles.index", [
            'entity' => 'roles'
        ]);
    }

    public function edit($id){

        $role = Role::with('permissions')->findOrFail($id);

        $permissions = \App\Models\Permission::all(['id', 'code', 'title', 'group']);

        if(request()->ajax()){
            return view("dashboard.pages.roles.partials.edit", [
                'role' => $role,
                'permissions' => $permissions->groupBy('group')
            ]);
        }
        abort(404);
    }

    public function update($id, Request $request){
        $role = Role::with('permissions')->findOrFail($id);
        $role->permissions()->sync($request->get('permissions'));
        Artisan::call("cache:clear");
        return redirect()->back();
    }

    public function store(Request $request){

        $title = $request->get('title');

        $role = Role::create([
            'code'          => Str::slug($title, '_'),
            'title'         => $title,
        ]);

        if($request->has('permissions')){
            $permissions = $request->get('permissions');
            $role->permissions()->sync($permissions);
        }

        Artisan::call("cache:clear");

        return redirect()->back();
    }

    public function delete(){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            if(!is_array($ids)){
                $ids = [$ids];
            }
            try {
                foreach ($ids as $id){
                    $role = Role::with("permissions")->findOrFail($id);
                    $role->permissions()->sync([]);
                    $role->delete();
                }
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}