<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                    $return[$locale.'.name'] = 'required|string|unique:product_translations,name|min:3|max:191';
                    $return[$locale.'.description'] = 'required|string|min:3';
                }
                $return['category_id'] = 'required|integer|exists:categories,id';
                $return['image'] = 'nullable|image';
                $return['purchase_price'] = 'required|numeric';
                $return['sale_price'] = 'required|numeric';
                $return['stock'] = 'required|numeric';
                return $return;
            }
            case 'PUT':
            case 'PATCH':
            {
                $return = [];
                foreach (config('translatable.locales') as $locale){
                    $return[$locale.'.name'] = 'required|string|unique:category_translations,name,'.$this->product->id.',category_id|min:3|max:191';
                    $return[$locale.'.description'] = 'required|string|min:3';
                }
                $return['category_id'] = 'required|integer|exists:categories,id';
                $return['image'] = 'nullable|image';
                $return['purchase_price'] = 'required|numeric';
                $return['sale_price'] = 'required|numeric';
                $return['stock'] = 'required|numeric';
                return $return;
            }
            default:break;
        }
    }
}
