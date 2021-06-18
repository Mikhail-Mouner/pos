<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        switch($this->method()){
            case 'GET':
            {
                return [
                    'search' => 'nullable|string|min:2|max:191',
                ];
            }
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|string|unique:clients,name|min:3|max:191',
                    'phone' => 'required|string|min:5|max:11',
                    'address' => 'required|string|min:3|max:191',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string|unique:clients,name,'.$this->client->id.'|min:3|max:191',
                    'phone' => 'required|string|min:5|max:11',
                    'address' => 'required|string|min:3|max:191'
                ];
            }
            default:break;
        }
    }
}
