<?php

namespace App\Services;

use App\Models\AdmPageProfile;
use App\Models\AdmProfile;

class AdmPageProfileService
{

    public function __construct() { }

    /**
     * @return AdmPageProfile[]
     */
    public function findAll()
    {
        $listAdmPageProfile = AdmPageProfile::all();
        return $listAdmPageProfile;
    }

    /**
     * @return AdmPageProfile[]
     */
    public function findByIdPage(int $admPageId){
        return AdmPageProfile::where('pgl_pag_seq', $admPageId)->get();
    }

    /**
     * @return AdmPageProfile[]
     */
    public function findByIdProfile(int $admProfileId){
        return AdmPageProfile::where('pgl_prf_seq', $admProfileId)->get();
    }

    /**
     * @return AdmProfile[]
     */
    public function getProfilesByPage(int $admPageId)
    {
        $listAdmPageProfile = $this->findByIdPage($admPageId);
        $lista = array();

        foreach ($listAdmPageProfile as $item)
        {
            array_push($lista, $item->getAdmProfileAttribute());
        }

        return $lista;
    }

    /**
     * @return AdmPage[]
     */
    public function getPagesByProfile(int $admProfileId)
    {
        $listAdmPageProfile = $this->findByIdProfile($admProfileId);

        $lista = array();

        foreach ($listAdmPageProfile as $item)
        {
            array_push($lista, $item->getAdmPageAttribute());
        }

        return $lista;
    }
}
