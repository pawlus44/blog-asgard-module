<?php

namespace Modules\Blog\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class StoreCategoryRequest extends BaseFormRequest
{
    public function translationRules()
    {
        return [
            'name' => 'required',
            'slug' => 'required',
            'display_name' => 'required',
        ];
    }

    public function rules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [
            'name.required' => trans('blog::messages.name is required'),
            'slug.required' => trans('blog::messages.slug is required'),
            'display_name.required' => trans('blog::messages.display_name is required')
        ];
    }
}
