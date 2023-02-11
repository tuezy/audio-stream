<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingsRequest;
use App\Repository\Settings\SettingRepositoryContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    protected $settings;

    protected $settingRepository;


    public function __construct(SettingRepositoryContract $settingRepository)
    {
        $this->middleware('auth');
        $this->settings = config('settings');
        $this->settingRepository = $settingRepository;
    }

    public function index(){
        return view("dashboard.pages.settings.index", [
            'settings' => $this->settings,
            'keys'  => array_keys($this->settings)
        ]);
    }

    public function store(SettingsRequest $request){

        $validated = $request->validated();

        foreach ($validated as $key => $value){

            if($value == 'on'){
                $value = 'true';
            }

            $this->settingRepository->updateOrCreate(
                [
                    'key' => $key
                ],
                [
                    'value' => $value
                ]);
        }

        Cache::forget('settings');
        Session::flash("alert_success", "Settings Updated!");

        return redirect()->route('dashboard.settings.index');
    }
}
