<?php

namespace App\Http\Requests;

class ProductRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->product ? ',' . $this->product->id : '';
        return $rules = [
            'name' => 'bail|required|max:255',
            'slug' => 'bail|required|max:255|unique:categories,slug' . $id,
            'featured_image' => 'bail|required',
            'price' => 'bail|required',
            'stock' => 'bail|required',
            'active' => 'bail|required',
            'category' => 'bail|required',
        ];
    }

    public function attributes()
    {
        return [
            'featured_image' => 'Product Image',
        ];
    }
}
