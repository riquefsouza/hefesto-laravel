<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AdmProfile;

class AdmProfileFormRequest extends FormRequest
{

    public function model(): AdmProfile
    {
        $model = new AdmProfile();
        $model->setIdAttribute(intval($this->id));
        $model->setAdministratorAttribute($this->administrator);
        $model->setDescriptionAttribute($this->description);
        $model->setGeneralAttribute($this->general);
        $model->setAdmPagesAttribute($this->admPages);
        $model->setAdmUsersAttribute($this->admUsers);
        $model->setProfilePagesAttribute($this->profilePages);
        $model->setProfileUsersAttribute($this->profileUsers);
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
