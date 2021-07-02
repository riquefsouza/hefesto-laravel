<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AdmParameterCategory;

class AdmParameterCategoryFormRequest extends FormRequest
{

    public function model(): AdmParameterCategory
    {
        $model = new AdmParameterCategory();
        $model->setIdAttribute(intval($this->id));
        $model->setDescriptionAttribute($this->description);
        $model->setOrderAttribute(intval($this->order));
        return $model;
    }

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
        return [
            'description' => 'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The field :attribute is required',
            'description.min' => 'The description field must be at least 5 characters long.'
        ];
    }

}
