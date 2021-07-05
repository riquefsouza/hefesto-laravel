<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AdmPage;

class AdmPageFormRequest extends FormRequest
{

    public function model(): AdmPage
    {
        $model = new AdmPage();
        $model->setIdAttribute(intval($this->id));
        $model->setDescriptionAttribute($this->description);
        $model->setUrlAttribute($this->url);
        $model->setAdmIdProfilesAttribute($this->admIdProfiles);
        $model->setPageProfilesAttribute($this->pageProfiles);
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
