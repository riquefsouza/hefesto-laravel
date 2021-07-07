<?php

namespace App\Base\Services;

use App\Models\AdmMenu;
use App\Admin\VO\MenuVO;
use App\Admin\VO\PageVO;
use App\Admin\VO\UserVO;
use App\Admin\VO\AuthenticatedUserVO;
use App\Admin\Services\AdmMenuService;
use App\Admin\Services\AdmUserService;
use App\Base\Models\MenuItemDTO;
use Illuminate\Support\Facades\Log;

class SystemService implements ISystemService
{
    /**
     * @return AdmMenuService
     */
    private $serviceMenu;

    /**
     * @return AuthenticatedUserVO|null
     */
    private AuthenticatedUserVO|null $authenticatedUser;

    /**
     * @return AdmUserService
     */
    private $userService;

    /**
     * @return ModeTestService
     */
    private $modeTestService;

    public function __construct(AdmMenuService $serviceMenu,
        ModeTestService $modeTestService, AdmUserService $userService)
    {
        $this->serviceMenu = $serviceMenu;
        $this->modeTestService = $modeTestService;
        $this->userService = $userService;

        $this->authenticatedUser = new AuthenticatedUserVO();
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
            $this->serviceMenu->setTransientWithoutSubMenus($plist);
            $this->serviceMenu->setTransientSubMenus($admMenu, $plist);
        }
        return $lista;
    }

    public function findAdminMenuParentByIdProfiles(array $listaIdProfile){
        $lista = $this->pfindAdminMenuParentByIdProfiles($listaIdProfile);

        foreach ($lista as $admMenu) {
            $plist = $this->findAdminMenuByIdProfiles($listaIdProfile, $admMenu->getIdAttribute());
            $this->serviceMenu->setTransientWithoutSubMenus($plist);
            $this->serviceMenu->setTransientSubMenus($admMenu, $plist);
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
     * @return MenuVO[]|null
     */
    public function findMenuParentByProfile(array $listaIdProfile){
        $listaMenuParent = $this->findMenuParentByIdProfiles($listaIdProfile);
        return $this->serviceMenu->toListMenuVO($listaMenuParent);
    }

    /**
     * @return MenuVO[]|null
     */
    public function findAdminMenuParentByProfile(array $listaIdProfile){
        $listaAdminMenuParent = $this->findAdminMenuParentByIdProfiles($listaIdProfile);
        return $this->serviceMenu->toListMenuVO($listaAdminMenuParent);
    }

    public function authenticate(UserVO $admUser): bool
    {
        $user = $this->userService->findOneUserByLogin($admUser->getLogin());

        if ($user!=null)
        {
            if (password_verify($admUser->getPassword(), $user->getPasswordAttribute()))
            {
                $userVO = new UserVO();
                $userVO->CreateWithEmail($user->getIdAttribute(), $user->getEmailAttribute(),
                    $user->getLoginAttribute(), $user->getNameAttribute(), $user->getActiveAttribute());
                $this->setProperties($admUser->getLogin(), $userVO);
                return true;
            }
        }

        return false;
    }

    private function setProperties(string $login, UserVO $userVO): void
    {
        $this->authenticatedUser->setUserName($login);
        $this->authenticatedUser->setUser($userVO);
        $this->authenticatedUser = $this->modeTestService->mountAuthenticatedUser($this, $userVO,
                $this->authenticatedUser, true);

        $this->authenticatedUser = $this->modeTestService->start($this, $userVO, $this->authenticatedUser, true);

        if ($this->authenticatedUser->getModeTest() && strlen($this->authenticatedUser->getModeTestLoginVirtual()) > 0)
        {
            $vUser = $this->userService->getUser($this->authenticatedUser->getUserName(),
                $this->authenticatedUser->getDisplayName(), $this->authenticatedUser->getEmail(), false);
            $this->authenticatedUser->setUser($vUser->toUserVO());
        }
        else
        {
            $this->authenticatedUser->setUser($userVO);
        }

        Log::info($this->authenticatedUser->getUserName() . ", Profiles: "
                . implode(",", $this->authenticatedUser->getListPermission()));
        $this->showProfileURL();
        $this->showMenus();
    }

    public function showProfileURL(): void
    {
        foreach ($this->authenticatedUser->getListPermission() as $permissao)
        {
            foreach ($permissao->getPages() as $admPagina)
            {
                Log::info("Profile: " . $permissao->getProfile()->getDescription() . " -> Page URL: " . $admPagina->getUrl());
            }
        }
    }

    public function showMenus(): void
    {
        foreach ($this->authenticatedUser->getListMenus() as $menu)
        {
            Log::info("Menu: " . $menu->__toString());
        }
        foreach ($this->authenticatedUser->getListAdminMenus() as $menu)
        {
            Log::info("Menu Admin: " . $menu->__toString());
        }
    }

    /**
     * @return MenuVO[]|null
     */
    public function getListaMenus()
    {
        return $this->authenticatedUser->getListMenus();
    }

    /**
     * @return MenuVO[]|null
     */
    public function getListaAdminMenus()
    {
        return $this->authenticatedUser->getListAdminMenus();
    }

    /**
     * @return PageVO|null
     */
    public function getPagina(int $idMenu): PageVO|null
    {
        return $this->authenticatedUser->getPageByMenu($idMenu);
    }

    /**
     * @return AuthenticatedUserVO|null
     */
    public function getAuthenticatedUser(): AuthenticatedUserVO|null
    {
        return $this->authenticatedUser;
    }

}
