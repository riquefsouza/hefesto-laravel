<?php

namespace App\Admin\Services;

use App\Models\AdmMenu;
use App\Models\AdmPage;
use App\Base\Models\MenuItemDTO;
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

	public function findMenuByIdProfiles(array $listaIdProfile, int $admMenuId) {
        /*
        $sql = "select distinct mnu.mnu_seq, mnu.mnu_description, mnu.mnu_parent_seq,
            mnu.mnu_pag_seq, mnu.mnu_order
            from adm_profile prf
            inner join adm_page_profile pgl on prf.prf_seq=pgl.pgl_prf_seq
            inner join adm_page pag on pgl.pgl_pag_seq=pag.pag_seq
            inner join adm_menu mnu on pag.pag_seq=mnu.mnu_pag_seq
            where prf.prf_seq in (${listaIdProfile}) and mnu.mnu_seq > 9 and mnu.mnu_parent_seq=${admMenuId}
            order by mnu.mnu_seq, mnu.mnu_order";
        */

        $lista = AdmMenu::from('adm_profile')
        ->join('adm_page_profile', 'adm_profile.prf_seq', '=', 'adm_page_profile.pgl_prf_seq')
        ->join('adm_page', 'adm_page_profile.pgl_pag_seq', '=', 'adm_page.pag_seq')
        ->join('adm_menu', 'adm_page.pag_seq', '=', 'adm_menu.mnu_pag_seq')
        ->whereIn('adm_profile.prf_seq', $listaIdProfile)
        ->where('adm_menu.mnu_seq','>', 9)
        ->where('adm_menu.mnu_parent_seq', $admMenuId)
        ->orderBy('adm_menu.mnu_seq')
        ->orderBy('adm_menu.mnu_order')
        ->get();

        return $lista;
    }

	public function findAdminMenuByIdProfiles(array $listaIdProfile, int $admMenuId) {
        /*
        $sql = "select distinct mnu.mnu_seq, mnu.mnu_description, mnu.mnu_parent_seq,
            mnu.mnu_pag_seq, mnu.mnu_order
            from adm_profile prf
            inner join adm_page_profile pgl on prf.prf_seq=pgl.pgl_prf_seq
            inner join adm_page pag on pgl.pgl_pag_seq=pag.pag_seq
            inner join adm_menu mnu on pag.pag_seq=mnu.mnu_pag_seq
            where prf.prf_seq in (${listaIdProfile}) and mnu.mnu_seq > 9 and mnu.mnu_parent_seq=${admMenuId}
            order by mnu.mnu_seq, mnu.mnu_order";
        */

        $lista = AdmMenu::from('adm_profile')
        ->join('adm_page_profile', 'adm_profile.prf_seq', '=', 'adm_page_profile.pgl_prf_seq')
        ->join('adm_page', 'adm_page_profile.pgl_pag_seq', '=', 'adm_page.pag_seq')
        ->join('adm_menu', 'adm_page.pag_seq', '=', 'adm_menu.mnu_pag_seq')
        ->whereIn('adm_profile.prf_seq', $listaIdProfile)
        ->where('adm_menu.mnu_seq','<=', 9)
        ->where('adm_menu.mnu_parent_seq', $admMenuId)
        ->orderBy('adm_menu.mnu_seq')
        ->orderBy('adm_menu.mnu_order')
        ->get();

        return $lista;
    }

    public function pfindMenuParentByIdProfiles(array $listaIdProfile){
        /*
        $sql = "select distinct mnu.mnu_seq, mnu.mnu_description, mnu.mnu_parent_seq, mnu.mnu_pag_seq, mnu.mnu_order
                from adm_menu mnu
                where mnu.mnu_seq in (
                    select distinct mnu.mnu_parent_seq
                    from adm_profile prf
                    inner join adm_page_profile pgl on prf.prf_seq=pgl.pgl_prf_seq
                    inner join adm_page pag on pgl.pgl_pag_seq=pag.pag_seq
                    inner join adm_menu mnu on pag.pag_seq=mnu.mnu_pag_seq
                    where prf.prf_seq in (${listaIdProfile}) and mnu.mnu_seq > 9
                )
                order by mnu.mnu_order, mnu.mnu_seq";
        */

        $subsql = AdmMenu::select('adm_menu.mnu_parent_seq')
        ->from('adm_profile')
        ->join('adm_page_profile', 'adm_profile.prf_seq', '=', 'adm_page_profile.pgl_prf_seq')
        ->join('adm_page', 'adm_page_profile.pgl_pag_seq', '=', 'adm_page.pag_seq')
        ->join('adm_menu', 'adm_page.pag_seq', '=', 'adm_menu.mnu_pag_seq')
        ->whereIn('adm_profile.prf_seq', $listaIdProfile)
        ->where('adm_menu.mnu_seq','>', 9);

        $lista = AdmMenu::whereIn('adm_menu.mnu_seq', $subsql)
        ->orderBy('adm_menu.mnu_order')
        ->orderBy('adm_menu.mnu_seq')
        ->get();

        return $lista;
    }

	public function pfindAdminMenuParentByIdProfiles(array $listaIdProfile){
        /*
        $sql = "select distinct mnu.mnu_seq, mnu.mnu_description, mnu.mnu_parent_seq, mnu.mnu_pag_seq, mnu.mnu_order
                from adm_menu mnu
                where mnu.mnu_seq in (
                    select distinct mnu.mnu_parent_seq
                    from adm_profile prf
                    inner join adm_page_profile pgl on prf.prf_seq=pgl.pgl_prf_seq
                    inner join adm_page pag on pgl.pgl_pag_seq=pag.pag_seq
                    inner join adm_menu mnu on pag.pag_seq=mnu.mnu_pag_seq
                    where prf.prf_seq in (${listaIdProfile}) and mnu.mnu_seq <= 9
                )
                order by mnu.mnu_order, mnu.mnu_seq";
        */

        $subsql = AdmMenu::select('adm_menu.mnu_parent_seq')
        ->from('adm_profile')
        ->join('adm_page_profile', 'adm_profile.prf_seq', '=', 'adm_page_profile.pgl_prf_seq')
        ->join('adm_page', 'adm_page_profile.pgl_pag_seq', '=', 'adm_page.pag_seq')
        ->join('adm_menu', 'adm_page.pag_seq', '=', 'adm_menu.mnu_pag_seq')
        ->whereIn('adm_profile.prf_seq', $listaIdProfile)
        ->where('adm_menu.mnu_seq','<=', 9);

        $lista = AdmMenu::whereIn('adm_menu.mnu_seq', $subsql)
        ->orderBy('adm_menu.mnu_order')
        ->orderBy('adm_menu.mnu_seq')
        ->get();

        return $lista;
    }

    public function findMenuParentByIdProfiles(array $listaIdProfile){
        $lista = $this->pfindMenuParentByIdProfiles($listaIdProfile);

        foreach ($lista as $admMenu) {
            $plist = $this->findMenuByIdProfiles($listaIdProfile, $admMenu->getIdAttribute());
            $this->setTransientWithoutSubMenus($plist);
            $this->setTransientSubMenus($admMenu, $plist);
        }
        return $lista;
    }

    public function findAdminMenuParentByIdProfiles(array $listaIdProfile){
        $lista = $this->pfindAdminMenuParentByIdProfiles($listaIdProfile);

        foreach ($lista as $admMenu) {
            $plist = $this->findAdminMenuByIdProfiles($listaIdProfile, $admMenu->getIdAttribute());
            $this->setTransientWithoutSubMenus($plist);
            $this->setTransientSubMenus($admMenu, $plist);
        }
        return $lista;
    }

    /**
     * @return MenuItemDTO[]
     */
    public function mountMenuItem(array $listaIdProfile)
    {

        $lista = array();

        $listMenus = $this->findMenuParentByIdProfiles($listaIdProfile);

        foreach ($listMenus as $menu) {
            $item = array();
            $admSubMenus = $menu->getAdmSubMenus();

            foreach ($admSubMenus as $submenu) {
                $submenuVO = new MenuItemDTO();
                $submenuVO->create($submenu->getDescriptionAttribute(), $submenu->getUrlAttribute());
                array_push($item, $submenuVO);
            };

            $vo = new MenuItemDTO();
            $vo->createWithItems($menu->getDescription(), $menu->getUrlAttribute(), $item);
            array_push($lista, $vo);
        };

        $listAdminMenus = $this->findAdminMenuParentByIdProfiles($listaIdProfile);

        foreach ($listAdminMenus as $menu) {
            $item = array();
            $admSubMenus = $menu->getAdmSubMenus();

            foreach ($admSubMenus as $submenu) {
                $submenuVO = new MenuItemDTO();
                $submenuVO->create($submenu->getDescriptionAttribute(), $submenu->getUrlAttribute());
                array_push($item, $submenuVO);
            };

            $vo = new MenuItemDTO();
            $vo->createWithItems($menu->getDescriptionAttribute(), $menu->getUrlAttribute(), $item);
            array_push($lista, $vo);
        };

        return $lista;
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

}
