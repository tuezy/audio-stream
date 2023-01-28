<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $settings = config("settings");

        $validation = [];

        foreach ($settings as $setting){
            foreach($setting as $config){
                $validation[$config['key']] = $config['validation'] ?? '';
            }
        }
        return $validation;
    }
}
