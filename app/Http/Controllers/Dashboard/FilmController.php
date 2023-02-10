<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\Films\FilmRepositoryContract;

use App\Datatables\FilmTables;
use App\Models\Film;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    protected $films;

    protected $filmRepository;


    public function __construct(FilmRepositoryContract $filmRepository)
    {
        $this->middleware('auth');

        $this->films = config('films');
        $this->filmRepository = $filmRepository;


    }


    public function index(FilmTables $datatables){
            return $datatables->render("dashboard.pages.films.index", [
                'entity' => "films"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.films.create");
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

        $this->filmRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = Film::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.films.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.films.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.films.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = Film::find($id);

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
                Films::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
