<?php

namespace App\Admin\Services;

use App\Models\AdmPage;
use App\Admin\Services\AdmPageProfileService;
use Illuminate\Database\Eloquent\Collection;
use App\Base\Services\IBaseCrud;
use App\Base\Pagination\PaginationFilter;
use App\Base\Pagination\BasePaged;
use App\Base\Pagination\BasePaging;

class AdmPageService implements IBaseCrud
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

    /**
     * @return BasePaged
     */
    public function getPage(string $route, PaginationFilter $filter): BasePaged
    {
        $validFilter = new PaginationFilter($filter->getPageNumber(), $filter->getSize(),
            $filter->getSort(), $filter->getColumnOrder(), $filter->getColumnTitle());

        //$pagedData = AdmPage::paginate(15);
        $pagedData = AdmPage::skip(($validFilter->getPageNumber() - 1) * $validFilter->getSize())
            ->take($validFilter->getSize())->get();
        //$pagedData = AdmPage::offset(0)->limit(10)->get();
        $totalRecords = AdmPage::count();

        return new BasePaged($pagedData,
            BasePaging::of($validFilter, $totalRecords, $this->uriService, $route));
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $list = AdmPage::all();
        $this->setTransientList($list);

        return $list;
    }

    /**
     * @return AdmPage|null
     */
    public function findById(int $id)
    {
        $obj = AdmPage::find($id);
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
        $model = AdmPage::find($id);
        if (is_null($model)) {
            return false;
        }
        $model->fill($obj);
        $model->save();

        return true;
    }

    /**
     * @return AdmPage
     */
    public function insert($obj)
    {
        $model = new AdmPage();
        $model->fill($obj);
        $model->save();

        return $model;
        //return AdmPage::create($obj);
    }

    /**
     * @return bool
     */
    public function delete(int $id): bool
    {
        $qty = AdmPage::destroy($id);
        return ($qty !== 0);
    }

    /**
     * @return bool
     */
    public function exists(int $id): bool
    {
        $model = AdmPage::find($id);
        return (!is_null($model));
    }
}
