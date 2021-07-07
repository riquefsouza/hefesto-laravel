<?php

namespace App\Base\Services;

use App\Models\AdmMenu;
use App\Admin\VO\MenuVO;
use App\Admin\VO\PageVO;
use App\Admin\VO\UserVO;
use App\Admin\VO\AuthenticatedUserVO;
use Illuminate\Database\Eloquent\Collection;

interface ISystemService {

    /**
     * @return Collection|null
     */
    public function findMenuByIdProfiles(array $listaIdProfile, int $admMenuId);

    /**
     * @return Collection|null
     */
    public function findAdminMenuByIdProfiles(array $listaIdProfile, int $admMenuId);

    /**
     * @return Collection|null
     */
    public function findMenuParentByIdProfiles(array $listaIdProfile);

    /**
     * @return Collection|null
     */
    public function findAdminMenuParentByIdProfiles(array $listaIdProfile);

    /**
     * @return MenuItemDTO[]|null
     */
    public function mountMenuItem(array $listaIdProfile);

    /**
     * @return MenuVO[]|null
     */
    public function findMenuParentByProfile(array $listaIdProfile);

    /**
     * @return MenuVO[]|null
     */
    public function findAdminMenuParentByProfile(array $listaIdProfile);

    public function authenticate(UserVO $admUser): bool;

    /**
     * @return MenuVO[]|null
     */
    public function getListaMenus();

    /**
     * @return MenuVO[]|null
     */
    public function getListaAdminMenus();

    /**
     * @return PageVO|null
     */
    public function getPagina(int $idMenu): PageVO|null;

    /**
     * @return AuthenticatedUserVO|null
     */
    public function getAuthenticatedUser(): AuthenticatedUserVO|null;

}
