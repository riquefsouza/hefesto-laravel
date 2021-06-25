<?php

namespace App\Services;

use App\Models\AdmPage;
use App\Services\AdmPageProfileService;
use Illuminate\Database\Eloquent\Collection;

class AdmPageService
{
    /**
     * @var AdmPageProfileService
     */
    private $service;

    public function __construct(AdmPageProfileService $service) {
        $this->service = $service;
    }

    public function setTransientList(Collection $list): void
    {
        foreach ($list as $item)
        {
            $this->setTransient($item);
        }
    }

    public function setTransient(AdmPage $item): void
    {
        $obj = $this->service->getProfilesByPage($item->getIdAttribute());
        foreach ($obj as $profile) {
            array_push($item->getAdmIdProfilesAttribute(), $profile->getIdAttribute());
        }

        $listPageProfiles = array();
        foreach ($obj as $profile) {
            array_push($listPageProfiles, $profile->getDescriptionAttribute());
        }
        $item->setPageProfilesAttribute(implode(",", $listPageProfiles));
    }

}
