<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'first_name' => 'required|string|min:3|max:191',
                    'last_name' => 'nullable|string|min:3|max:191',
                    'e_mail' => 'required|email|unique:users,email|min:3|max:191',
                    'password' => 'required|confirmed|string|min:6|max:191',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'first_name' => 'required|string|min:3|max:191',
                    'last_name' => 'nullable|string|min:3|max:191',
                    'e_mail' => 'required|email|unique:users,email,'.$this->user->id.'|min:3|max:191',
                    'password' => 'nullable|confirmed|string|min:6|max:191',
                ];
            }
            default:break;
        }
    }
}
