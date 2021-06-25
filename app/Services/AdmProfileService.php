<?php

namespace App\Services;

use App\Models\AdmProfile;
use App\Services\AdmPageProfileService;
use App\Services\AdmUserProfileService;
use Illuminate\Database\Eloquent\Collection;

class AdmProfileService
{
    /**
     * @var AdmPageProfileService
     */
    private $pageProfileService;

    /**
     * @var AdmUserProfileService
     */
    private $userProfileService;

    public function __construct(AdmPageProfileService $pageProfileService,
        AdmUserProfileService $userProfileService) {
        $this->pageProfileService = $pageProfileService;
        $this->userProfileService = $userProfileService;
    }

    /**
     * @return AdmProfile[]
     */
    public function findProfilesByPage(int $pageId)
    {
        $admProfileList = $this->pageProfileService->getProfilesByPage($pageId);
        $this->setTransientList(new Collection($admProfileList));
        return $admProfileList;
    }

    /**
     * @return AdmProfile[]
     */
    public function findProfilesByUser(int $userId)
    {
        $admProfileList =  $this->userProfileService->getProfilesByUser($userId);
        $this->setTransientList(new Collection($admProfileList));
        return $admProfileList;
    }

    public function setTransientList(Collection $list): void
    {
        foreach ($list as $item)
        {
            $this->setTransient($item);
        }
    }

    public function setTransient(AdmProfile $item): void
    {

        $listPages = $this->pageProfileService->getPagesByProfile($item->getIdAttribute());
        foreach ($listPages as $page) {
            array_push($item->getAdmPagesAttribute(), $page);
        }

        $listProfilePages = array();
        foreach ($item->getAdmPagesAttribute() as $page) {
            array_push($listProfilePages, $page->getDescriptionAttribute());
        }
        $item->setProfilePagesAttribute(implode(",", $listProfilePages));


        $listUsers = $this->userProfileService->getUsersByProfile($item->getIdAttribute());
        foreach ($listUsers as $user) {
            array_push($item->getAdmUsersAttribute(), $user);
        }

        $listProfileUsers = array();
        foreach ($item->getAdmUsersAttribute() as $user) {
            array_push($listProfileUsers, $user->getNameAttribute());
        }
        $item->setProfileUsersAttribute(implode(",", $listProfileUsers));
    }

}
