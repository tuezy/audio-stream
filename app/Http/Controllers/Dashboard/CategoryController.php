<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\Categories\CategoryRepositoryContract;

use App\Datatables\CategoryTables;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $categories;

    protected $categoryRepository;


    public function __construct(CategoryRepositoryContract $categoryRepository)
    {
        $this->middleware('auth');

        $this->categories = config('categories');
        $this->categoryRepository = $categoryRepository;


    }


    public function index(CategoryTables $datatables){
            return $datatables->render("dashboard.pages.categories.index", [
                'entity' => "categories"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.categories.create");
    }

    public function store(Request $request){
        $input = $request->all();

        $rules = array(
            'title'  => 'required|string'
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }

        $this->categoryRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = Category::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.categories.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.categories.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.categories.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = Category::find($id);

        $input = $request->except('_token');

        $rules = array(
                    'title'  => 'required|string'
                );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }
        $item->slug = null;
        $item->title = $input['title'];

        $item->save();

        return redirect()->back()->with('success', 'Item Updated');
    }

    public function delete($id){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                Categories::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
