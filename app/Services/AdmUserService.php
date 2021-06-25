<?php

namespace App\Services;

use App\Models\AdmUser;
use App\Services\AdmUserProfileService;
use Illuminate\Database\Eloquent\Collection;

class AdmUserService
{
    /**
     * @var AdmUserProfileService
     */
    private $service;

    public function __construct(AdmUserProfileService $service) {
        $this->service = $service;
    }

    public function setTransientList(Collection $list): void
    {
        foreach ($list as $item)
        {
            $this->setTransient($item);
        }
    }

    public function setTransient(AdmUser $item): void
    {
        $obj = $this->service->getProfilesByUser($item->getIdAttribute());
        foreach ($obj as $profile) {
            array_push($item->getAdmIdProfilesAttribute(), $profile->getIdAttribute());
        }

        $listUserProfiles = array();
        foreach ($obj as $profile) {
            array_push($listUserProfiles, $profile->getDescriptionAttribute());
        }
        $item->setUserProfilesAttribute(implode(",", $listUserProfiles));
    }

    /**
     * @return AdmUser|null
     */
    public function findOneUserByLogin(string $login): AdmUser|null {
        return AdmUser::where('usu_login', $login)->first();
    }

    public function authenticate(string $login, string $password): AdmUser|null
    {
        $admUser = $this->findOneUserByLogin($login);

        if ($admUser != null){
            if ($this->verifyPassword($password, $admUser->getPasswordAttribute())){
                return $admUser;
            }
        }
        return null;
    }

    public function verifyPassword(string $password, string $hashPassword): bool
    {
        return password_verify($password, $hashPassword);
    }

    public function register(AdmUser $model): void
    {
        $model->setPassword(password_hash($model->getPasswordAttribute(), PASSWORD_DEFAULT));
        /*
        $options = [
            'cost' => 10
        ];
        $model->setPassword(password_hash($model->getPassword(), PASSWORD_BCRYPT, $options));
        */
    }


}
