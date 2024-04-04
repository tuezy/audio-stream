<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

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

                if($config['type'] == 'boolean' && !$this->request->has($config['key']) ) {
                    $validation[$config['key']] = 'false';
                }
                if(empty($validation[$config['key']])) unset($validation[$config['key']]);
            }
        }
        return $validation;
    }

    protected function failedValidation(Validator $validator)
    {
        return Redirect::back()->with("error",$validator->errors()->first() );
    }
}
