<?php

namespace App\Admin\Services;

use App\Base\Pagination\PaginationFilter;
use App\Base\Pagination\BasePaged;
use App\Base\Pagination\BasePaging;
use App\Base\Services\IBaseCrud;
use App\Base\Services\IUriService;
use App\Models\AdmParameter;
use Exception;

class AdmParameterService implements IBaseCrud
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

        //$pagedData = AdmParameter::paginate(15);
        $pagedData = AdmParameter::skip(($validFilter->getPageNumber() - 1) * $validFilter->getSize())
            ->take($validFilter->getSize())->get();
        //$pagedData = AdmParameter::offset(0)->limit(10)->get();
        $totalRecords = AdmParameter::count();

        return new BasePaged($pagedData,
            BasePaging::of($validFilter, $totalRecords, $this->uriService, $route));
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return AdmParameter::all();
    }

    /**
     * @return AdmParameter|null
     */
    public function findById(int $id)
    {
        return AdmParameter::find($id);
    }

    /**
     * @return bool
     */
    public function update(int $id, $obj): bool
    {
        $model = AdmParameter::find($id);
        if (is_null($model)) {
            return false;
        }
        $model->fill($obj);
        $model->save();

        return true;
    }

    /**
     * @return AdmParameter
     */
    public function insert($obj)
    {
        $model = new AdmParameter();
        $model->fill($obj);
        $model->save();

        return $model;
        //return AdmParameter::create($obj);
    }

    /**
     * @return bool
     */
    public function delete(int $id): bool
    {
        $qty = AdmParameter::destroy($id);
        return ($qty !== 0);
    }

    /**
     * @return bool
     */
    public function exists(int $id): bool
    {
        $model = AdmParameter::find($id);
        return (!is_null($model));
    }

    public function getValueByCode(string $scode): string|null
    {
        try
        {
            $parameter = AdmParameter::where('par_code', $scode)->first();

            return $parameter->getValueAttribute();
        }
        catch (Exception)
        {
            return null;
        }
    }

}
