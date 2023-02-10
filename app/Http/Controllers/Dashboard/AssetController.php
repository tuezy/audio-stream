<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Datatables\AudioDatatables;
use App\Http\Controllers\Dashboard\Datatables\UserDatatables;
use App\Http\Requests\Dashboard\SettingsRequest;
use App\Models\Playlist;
use App\Repository\AudioRepository;
use App\Repository\PlaylistRepository;
use App\Repository\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class AssetController extends Controller{
    protected $asset_path = "upload/assets";


    public function index($type){
        return view("dashboard.pages.assets.create", ['type' => $type]);
    }
    public function asset($type, Request $request){
        $file = $request->file('file');
        $file->storeAs($this->asset_path . "/images/", $type.'.'.$file->getClientOriginalName());
    }
}