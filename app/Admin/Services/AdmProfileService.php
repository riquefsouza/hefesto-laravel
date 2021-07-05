<?php

namespace App\Admin\Services;

use App\Models\AdmProfile;
use App\Admin\Services\AdmPageProfileService;
use App\Admin\Services\AdmUserProfileService;
use Illuminate\Database\Eloquent\Collection;
use App\Base\Services\IBaseCrud;
use App\Base\Pagination\PaginationFilter;
use App\Base\Pagination\BasePaged;
use App\Base\Pagination\BasePaging;


class AdmProfileService implements IBaseCrud
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

        /**
     * @return BasePaged
     */
    public function getPage(string $route, PaginationFilter $filter): BasePaged
    {
        $validFilter = new PaginationFilter($filter->getPageNumber(), $filter->getSize(),
            $filter->getSort(), $filter->getColumnOrder(), $filter->getColumnTitle());

        //$pagedData = AdmProfile::paginate(15);
        $pagedData = AdmProfile::skip(($validFilter->getPageNumber() - 1) * $validFilter->getSize())
            ->take($validFilter->getSize())->get();
        //$pagedData = AdmProfile::offset(0)->limit(10)->get();
        $totalRecords = AdmProfile::count();

        return new BasePaged($pagedData,
            BasePaging::of($validFilter, $totalRecords, $this->uriService, $route));
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $list = AdmProfile::all();
        $this->setTransientList($list);

        return $list;
    }

    /**
     * @return AdmProfile|null
     */
    public function findById(int $id)
    {
        $obj = AdmProfile::find($id);
        if (!is_null($obj)) {
            $this->setTransient($obj);
        }

        return $obj;

    }

    /**
     * @return bool
     */
    public function update(int $id, $obj): bool
    {
        $model = AdmProfile::find($id);
        if (is_null($model)) {
            return false;
        }
        $model->fill($obj);
        $model->save();

        return true;
    }

    /**
     * @return AdmProfile
     */
    public function insert($obj)
    {
        $model = new AdmProfile();
        $model->fill($obj);
        $model->save();

        return $model;
        //return AdmProfile::create($obj);
    }

    /**
     * @return bool
     */
    public function delete(int $id): bool
    {
        $qty = AdmProfile::destroy($id);
        return ($qty !== 0);
    }

    /**
     * @return bool
     */
    public function exists(int $id): bool
    {
        $model = AdmProfile::find($id);
        return (!is_null($model));
    }
}
