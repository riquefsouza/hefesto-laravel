<?php

namespace App\Services;

use App\Models\AdmUser;
use App\Models\AdmUserProfile;
use App\Models\AdmProfile;
use Illuminate\Database\Eloquent\Collection;

class AdmUserProfileService
{

    public function __construct(){}

    public function setTransientList(Collection $list): void
    {
        foreach ($list as $item)
        {
            $item->AdmUser = AdmUser::find($item->getIdUserAttribute());
            $item->AdmProfile = AdmProfile::find($item->getIdProfileAttribute());
        }
    }

    public function setTransient(AdmUserProfile $item): void
    {
        $item->AdmUser = AdmUser::find($item->getIdUserAttribute());
        $item->AdmProfile = AdmProfile::find($item->getIdProfileAttribute());
    }

    /**
     * @return AdmUserProfile[]
     */
    public function findAll()
    {
        $listAdmUserProfile = AdmUserProfile::all();
        $this->setTransientList($listAdmUserProfile);
        return $listAdmUserProfile;
    }

    /**
     * @return AdmUserProfile[]
     */
    public function findByIdUser(int $admUserId){
        return AdmUserProfile::where('usp_use_seq', $admUserId)->get();
    }

    /**
     * @return AdmUserProfile[]
     */
    public function findByIdProfile(int $admProfileId){
        return AdmUserProfile::where('usp_prf_seq', $admProfileId)->get();
    }

    /**
     * @return AdmProfile[]
     */
    public function getProfilesByUser(int $admUserId)
    {
        $listAdmUserProfile = $this->findByIdUser($admUserId);

        $lista = array();

        foreach ($listAdmUserProfile as $item)
        {
            $this->setTransient($item);
            array_push($lista, $item->getAdmProfileAttribute());
        }

        return $lista;
    }

    /**
     * @return AdmUser[]
     */
    public function getUsersByProfile(int $admProfileId)
    {
        $listAdmUserProfile = $this->findByIdProfile($admProfileId);

        $lista = array();

        foreach ($listAdmUserProfile as $item)
        {
            $this->setTransient($item);
            array_push($lista, $item->getAdmUserAttribute());
        }

        return $lista;
    }
}
