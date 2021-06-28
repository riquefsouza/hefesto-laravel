<?php

namespace App\Admin\VO;

class PermissionVO
{
    /**
     * @return ProfileVO
     */
    private ProfileVO $profile;

    /**
     * @return PageVO[]
     */
    public $pages = array();

    public function __construct()
    {
        $this->pages = array();
        $this->Clean();
    }

    public function Clean(): void
    {
        $this->profile = new ProfileVO();
        $this->pages = [];
    }

    /**
     * @return PageVO[]|null
     */
    public function &getPages()
    {
        return $this->pages;
    }

    public function setPages(array $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @return ProfileVO
     */
    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile(ProfileVO $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function __toString(): string
    {
        //return "PermissionVO [profile=" + $this->profile + ", pages=" + $this->pages + "]";
        return serialize($this);
    }
}
