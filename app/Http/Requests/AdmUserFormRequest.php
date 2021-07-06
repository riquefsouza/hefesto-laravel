<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\AdmUser;

class AdmUserFormRequest extends FormRequest
{

    public function model(): AdmUser
    {
        $model = new AdmUser();
        $model->setIdAttribute(intval($this->id));
        $model->setActiveAttribute($this->active);
        $model->setEmailAttribute($this->email);
        $model->setLoginAttribute($this->login);
        $model->setNameAttribute($this->name);
        $model->setPasswordAttribute($this->password);
        $model->setAdmIdProfilesAttribute($this->admIdProfiles);
        $model->setUserProfilesAttribute($this->userProfiles);
        $model->setCurrentPasswordAttribute($this->currentPassword);
        $model->setNewPasswordAttribute($this->newPassword);
        $model->setConfirmNewPasswordAttribute($this->confirmNewPassword);
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
