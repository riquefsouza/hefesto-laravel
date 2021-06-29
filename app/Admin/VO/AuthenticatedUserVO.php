<?php

namespace App\Admin\VO;

use App\Base\Util\IComparable;

class AuthenticatedUserVO implements IComparable
{
    /**
     * @var string
     */
    private string $userName;

    /**
     * @var string
     */
    private string $displayName;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var PermissionVO[]
     */
    private $listPermission = array();

    /**
     * @var MenuVO[]
     */
    private $listMenus = array();

    /**
     * @var MenuVO[]
     */
    private $listAdminMenus = array();

    /**
     * @var UserVO
     */
    private UserVO $user;

    /**
     * @var bool
     */
    private bool $modeTest;

    /**
     * @var string
     */
    private string $modeTestLogin;

    /**
     * @var string
     */
    private string $modeTestLoginVirtual;

    public function __construct()
    {
        $this->listPermission = array();
        $this->listMenus = array();
        $this->listAdminMenus = array();
        $this->user = new UserVO();

        $this->Clean();

        $this->modeTest = false;
        $this->modeTestLogin = "";
        $this->modeTestLoginVirtual = "";
    }

    public function Create(string $userName)
    {
        $this->userName = $userName;
    }

    public function Clean(): void
    {
        $this->userName = "";
        $this->displayName = "";
        $this->email = "";
        $this->listPermission = [];
        $this->listMenus = [];
        $this->listAdminMenus = [];
        $this->user->Clean();
        $this->modeTestLogin = "";
        $this->modeTestLoginVirtual = "";
    }

    public function compare($object): bool
    {
        return $this->__toString() === $object->__toString();
    }

    public function __toString(): string
    {
        return serialize($this);
    }

    public function getProfileById(int $idProfile): ProfileVO
    {
        $admProfile = null;
        foreach ($this->listPermission as $permissaoVO)
        {
            if ($permissaoVO->getProfile()->getId() === $idProfile)
            {
                $admProfile = $permissaoVO->getProfile();
                break;
            }
        }
        return $admProfile;
    }

    public function isProfileById(int $idProfile): bool
    {
        return ($this->getProfile($idProfile) != null);
    }

    public function getProfile(string $profile): ProfileVO
    {
        $admProfile = null;
        foreach ($this->listPermission as $permissaoVO)
        {
            if ($permissaoVO->getProfile()->getDescription() === $profile)
            {
                $admProfile = $permissaoVO->getProfile();
                break;
            }
        }
        return $admProfile;
    }

    public function isProfile(string $profile): bool
    {
        return ($this->getProfile($profile) != null);
    }

    public function getProfileGeneral(): ProfileVO
    {
        $admProfile = null;
        foreach ($this->listPermission as $permissaoVO)
        {
            if ($permissaoVO->getProfile()->getGeneral())
            {
                $admProfile = $permissaoVO->getProfile();
                break;
            }
        }
        return $admProfile;
    }

    public function getProfileAdministrator(): ProfileVO
    {
        $admProfile = null;
        foreach ($this->listPermission as $permissaoVO)
        {
            if ($permissaoVO->getProfile()->getAdministrator())
            {
                $admProfile = $permissaoVO->getProfile();
                break;
            }
        }
        return $admProfile;
    }

    public function isGeneral(): bool
    {
        $profile = $this->getProfileGeneral();
        if ($profile != null)
        {
            return $profile->getGeneral();
        }
        return false;
    }

    public function isAdministrator(): bool
    {
        $profile = $this->getProfileAdministrator();
        if ($profile != null)
        {
            return $profile->getAdministrator();
        }
        return false;
    }

    public function getPageByMenu(int $idMenu): PageVO
    {
        $admPage = null;

        if ($this->listMenus != null && count($this->listMenus) > 0)
        {
            foreach ($this->listMenus as $admMenu)
            {
                $admPage = $admMenu->getPage();
                break;
            }
        }

        if ($this->listAdminMenus != null && count($this->listAdminMenus) > 0)
        {
            foreach ($this->listAdminMenus as $admMenu)
            {
                $admPage = $admMenu->getPage();
                break;
            }
        }

        return $admPage;
    }

    public function hasPermission(string $url, string $tela): bool
    {

        if ($url == null)
        {
            return false;
        }
        $pos = strpos($url, "private");
        $url = $pos > -1 ? substr($url, $pos + 8, strlen($url)) : $url;

        if ($url === $tela)
        {
            return true;
        }

        foreach ($this->listPermission as $permissao)
        {
            foreach ($permissao->getPages() as $admPage)
            {
                if ($admPage->getUrl() === $url)
                {
                    return true;
                }
            }
        }

        return false;
    }

    public function getMenu(string $sidMenu): MenuVO
    {
        $menu = null;
        $idMenu = intval($sidMenu);

        foreach ($this->listMenus as $item)
        {
            foreach ($item->getSubMenus() as $submenu){
                if ($submenu->getId() === $idMenu){
                    $menu = $submenu;
                    break;
                }
            }
            if ($menu != null)
            {
                break;
            }
        }

        if ($menu == null)
        {
            foreach ($this->listAdminMenus as $item)
            {
                foreach ($item->getSubMenus() as $submenu){
                    if ($submenu->getId() === $idMenu){
                        $menu = $submenu;
                        break;
                    }
                }
                if ($menu != null)
                {
                    break;
                }
            }
        }

        return $menu;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): void
    {
        $this->displayName = $displayName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return PermissionVO[]|null
     */
    public function &getListPermission()
    {
        return $this->listPermission;
    }

    public function setListPermission(array $listPermission): self
    {
        $this->listPermission = $listPermission;

        return $this;
    }

    /**
     * @return MenuVO[]|null
     */
    public function &getListMenus()
    {
        return $this->listMenus;
    }

    public function setListMenus(array $listMenus): self
    {
        $this->listMenus = $listMenus;

        return $this;
    }

    /**
     * @return MenuVO[]|null
     */
    public function &getListAdminMenus()
    {
        return $this->listAdminMenus;
    }

    public function setListAdminMenus(array $listAdminMenus): self
    {
        $this->listAdminMenus = $listAdminMenus;

        return $this;
    }

    public function getUser(): UserVO
    {
        return $this->user;
    }

    public function setUser(UserVO $user): void
    {
        $this->user = $user;
    }

    public function getModeTest(): bool
    {
        return $this->modeTest;
    }

    public function setModeTest(bool $modeTest): void
    {
        $this->modeTest = $modeTest;
    }

    public function getModeTestLogin(): string
    {
        return $this->modeTestLogin;
    }

    public function setModeTestLogin(string $modeTestLogin): void
    {
        $this->modeTestLogin = $modeTestLogin;
    }

    public function getModeTestLoginVirtual(): string
    {
        return $this->modeTestLoginVirtual;
    }

    public function setModeTestLoginVirtual(string $modeTestLoginVirtual): void
    {
        $this->modeTestLoginVirtual = $modeTestLoginVirtual;
    }

}
