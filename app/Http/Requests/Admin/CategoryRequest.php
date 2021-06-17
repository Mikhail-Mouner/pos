<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                $return = [];
                foreach (config('translatable.locales') as $locale){
                    $return[$locale.'.name'] = 'required|string|unique:category_translations,name|min:3|max:191';
                }
                return $return;
            }
            case 'PUT':
            case 'PATCH':
            {
                $return = [];
                foreach (config('translatable.locales') as $locale){
                    $return[$locale.'.name'] = 'required|string|unique:category_translations,name,'.$this->category->id.',category_id|min:3|max:191';
                }
                return $return;
            }
            default:break;
        }
    }
}
