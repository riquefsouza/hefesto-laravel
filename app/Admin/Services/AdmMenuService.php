<?php

namespace App\Admin\Services;

use App\Models\AdmMenu;
use App\Models\AdmPage;
use Illuminate\Database\Eloquent\Collection;
use App\Base\Services\IBaseCrud;
use App\Base\Pagination\PaginationFilter;
use App\Base\Pagination\BasePaged;
use App\Base\Pagination\BasePaging;


class AdmMenuService implements IBaseCrud
{

    public function __construct() {}

    public function setTransientWithoutSubMenus(Collection $list): void
    {
        foreach ($list as $item) {
            $this->setTransientSubMenus($item, null);
        }
    }

    public function setTransientList(Collection $list): void
    {
        foreach ($list as $item) {
            $this->setTransient($item);
        }
    }

    public function setTransientSubMenus(AdmMenu $item, Collection|null $subMenus): void
    {
        if ($item->getIdPageAttribute()!=null){
            $item->AdmPage = AdmPage::find($item->getIdPageAttribute());
        }
        if ($item->getIdMenuParentAttribute()!=null){
            $item->AdmMenuParent = AdmMenu::find($item->getIdMenuParentAttribute());
        }
        if ($subMenus!=null) {
            $item->setAdmSubMenus($subMenus);
        }
    }

    public function setTransient(AdmMenu $item)
    {
        $this->setTransientSubMenus($item, $this->findByIdMenuParent($item->getIdAttribute()));
    }

    public function findByIdMenuParent(int $idMenuParent){
        return AdmMenu::where('mnu_parent_seq', $idMenuParent)->get();
    }

    /**
     * @return BasePaged
     */
    public function getPage(string $route, PaginationFilter $filter): BasePaged
    {
        $validFilter = new PaginationFilter($filter->getPageNumber(), $filter->getSize(),
            $filter->getSort(), $filter->getColumnOrder(), $filter->getColumnTitle());

        //$pagedData = AdmMenu::paginate(15);
        $pagedData = AdmMenu::skip(($validFilter->getPageNumber() - 1) * $validFilter->getSize())
            ->take($validFilter->getSize())->get();
        //$pagedData = AdmMenu::offset(0)->limit(10)->get();
        $totalRecords = AdmMenu::count();

        return new BasePaged($pagedData,
            BasePaging::of($validFilter, $totalRecords, $this->uriService, $route));
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $list = AdmMenu::all();
        $this->setTransientList($list);

        return $list;
    }

    /**
     * @return AdmMenu|null
     */
    public function findById(int $id)
    {
        $obj = AdmMenu::find($id);
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
        $model = AdmMenu::find($id);
        if (is_null($model)) {
            return false;
        }
        $model->fill($obj);
        $model->save();

        return true;
    }

    /**
     * @return AdmMenu
     */
    public function insert($obj)
    {
        $model = new AdmMenu();
        $model->fill($obj);
        $model->save();

        return $model;
        //return AdmMenu::create($obj);
    }

    /**
     * @return bool
     */
    public function delete(int $id): bool
    {
        $qty = AdmMenu::destroy($id);
        return ($qty !== 0);
    }

    /**
     * @return bool
     */
    public function exists(int $id): bool
    {
        $model = AdmMenu::find($id);
        return (!is_null($model));
    }

    /**
     * @return MenuVO[]
     */
    public function toListMenuVO(Collection $listaMenu)
    {
        $lista = array();
        foreach ($listaMenu as $menu)
        {
            array_push($lista, $menu->toMenuVO());
        }
        return $lista;
    }

}
