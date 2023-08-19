<?php

namespace App\Http\Controllers\Dashboard;

use App\Datatables\CustomerTables;
use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Customer;
use App\Models\Playlist;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CustomerTables $datatables){
        return $datatables->render("dashboard.pages.customers.index", [
            'entity' => "customers"
        ]);
    }


    public function edit($id){
        $user =Customer::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.customers.partials.edit", [
                'user' => $user,
            ]);
        }
        abort(404);

    }

    public function update($id, Request $request){
        $user = Customer::find($id);

        $input = $request->except('_token');

        foreach ( $input as $key => $value){

            if($key == 'password'){
                if(is_null($value)) continue;
                else $user->{$key} = Hash::make($value);
            }
        }

        $user->save();

        return redirect()->back()->with('alert_success', 'User Updated');

    }

    public function store(Request $request){

        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $customer =  Customer::createOrUpdate([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        Event::dispatch('customers.after.store', $customer);

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
                    $playlists = Playlist::where('customer_id', '=', $id)->get();
                    foreach ($playlists as $playlist){
                        foreach ($playlist->audio() as $audio){
                            $path = $audio->path;
                            $deleted = File::delete(storage_path('app/'.Str::replace('storage', 'public', $path)));
                            if($deleted){
                                $audio->delete();
                            }
                        }
                        File::deleteDirectory(storage_path('app/public/hls/public/users/'.$playlist->customer_id.'/audios/'.$playlist->broadcast_date), true);
                        File::deleteDirectory(storage_path('app/public/users/'.$playlist->customer_id.'/audios/'.$playlist->broadcast_date), true);
                        $playlist->delete();
                    }
                    Customer::destroy($id);
                }

                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}