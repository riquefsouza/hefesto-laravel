<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AdmMenu;

class AdmMenuFormRequest extends FormRequest
{

    public function model(): AdmMenu
    {
        $model = new AdmMenu();
        $model->setIdAttribute(intval($this->id));
        $model->setDescriptionAttribute($this->description);
        $model->setIdMenuParentAttribute(intval($this->idMenuParent));
        $model->setIdPageAttribute(intval($this->idPage));
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
