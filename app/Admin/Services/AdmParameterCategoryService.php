<?php

namespace App\Admin\Services;

use App\Base\Pagination\PaginationFilter;
use App\Base\Pagination\BasePaged;
use App\Base\Pagination\BasePaging;
use App\Base\Services\IBaseCrud;
use App\Base\Services\IUriService;
use App\Models\AdmParameterCategory;

class AdmParameterCategoryService implements IBaseCrud
{
    /*
     * @var IUriService
     */
    //private IUriService $uriService;

    //public function __construct(IUriService $uriService)
    //{
       // $this->uriService = $uriService;
   // }

    /**
     * @return BasePaged
     */
    public function getPage(string $route, PaginationFilter $filter): BasePaged
    {
        $validFilter = new PaginationFilter($filter->getPageNumber(), $filter->getSize(),
            $filter->getSort(), $filter->getColumnOrder(), $filter->getColumnTitle());

        //$pagedData = AdmParameterCategory::paginate(15);
        $pagedData = AdmParameterCategory::skip(($validFilter->getPageNumber() - 1) * $validFilter->getSize())
            ->take($validFilter->getSize())->get();
        //$pagedData = AdmParameterCategory::offset(0)->limit(10)->get();
        $totalRecords = AdmParameterCategory::count();

        return new BasePaged($pagedData,
            BasePaging::of($validFilter, $totalRecords, $this->uriService, $route));
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return AdmParameterCategory::all();
    }

    /**
     * @return AdmParameterCategory|null
     */
    public function findById(int $id)
    {
        return AdmParameterCategory::find($id);
    }

    /**
     * @return bool
     */
    public function update(int $id, $obj): bool
    {
        $model = AdmParameterCategory::find($id);
        if (is_null($model)) {
            return false;
        }
        $model->fill($obj);
        $model->save();

        return true;
    }

    /**
     * @return AdmParameterCategory
     */
    public function insert($obj)
    {
        return AdmParameterCategory::create($obj);
    }

    /**
     * @return bool
     */
    public function delete(int $id): bool
    {
        $qty = AdmParameterCategory::destroy($id);
        return ($qty !== 0);
    }

    /**
     * @return bool
     */
    public function exists(int $id): bool
    {
        $model = AdmParameterCategory::find($id);
        return (!is_null($model));
    }

}
