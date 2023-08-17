<?php

namespace App\Http\Controllers\Dashboard;

use App\Datatables\CmsDatatables;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CmsController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CmsDatatables $datatables){
        return $datatables->render("dashboard.pages.cms.index", [
            'entity' => 'cms'
        ]);
    }

    public function edit($id){

        $item = Cms::findOrFail($id);

        return view("dashboard.pages.cms.edit", [
            'item' => $item,
            'entity' => 'cms'
        ]);
    }

    public function update($id, Request $request){

        $item = Cms::find($id);

        $input = $request->except('_token');

        $item->update($input);

        return redirect()->back()->with('success', 'Content Updated');
    }
    public function create(){
        return view("dashboard.pages.cms.create");
    }
    public function store(Request $request){
        $input = $request->all();

        $rules = array(
            'title'  => 'required|string',
            'content' => 'required|string',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }

        Cms::create($input);

        return redirect()->route("dashboard.cms.index");
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