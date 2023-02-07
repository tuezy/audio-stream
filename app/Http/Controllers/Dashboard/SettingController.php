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

        $settingsValues = Cache::get("settings");

        Cache::forget('settings');

        $updateValues = array_diff_assoc($validated, $settingsValues);

        foreach ($settingsValues as $key => $value){

            if($value == 'true' && !isset($updateValues[$key])){
                $updateValues[$key] = 'false';
            }
            if(!isset($updateValues[$key])){
                continue;
            }
            if($updateValues[$key] == 'on'){
                $updateValues[$key] = 'true';
            }

            $this->settingRepository->updateOrCreate(
                [
                    'key' => $key
                ],
                [
                    'value' => $updateValues[$key]
                ]);
        }

        Session::flash("alert_success", "Settings Updated!");

        return redirect()->route('dashboard.settings.index');
    }
}
