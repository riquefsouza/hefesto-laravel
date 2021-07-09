<?php

namespace App\Admin\VO;

class MenuVO
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var int|null
     */
    private int|null $order;

    /**
     * @var int|null
     */
    private int|null $idPage;

    /**
     * @return PageVO|null
     */
    private PageVO|null $page;

    /**
     * @return MenuVO|null
     */
    private MenuVO|null $menuParent;

    /**
     * @return MenuVO[]|null
     */
    private $subMenus = array();

    public function __construct()
    {
        $this->subMenus = array();
        $this->Clean();
    }

    public function Clean(): void
    {
        $this->id = -1;
        $this->description = "";
        $this->order = -1;
        $this->idPage = -1;
        $this->page = new PageVO();
        $this->menuParent = null;
        $this->subMenus = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $value): void
    {
        $this->description = $value;
    }

    public function getOrder(): int|null
    {
        return $this->order;
    }

    public function setOrder(int|null $value): void
    {
        $this->order = $value;
    }

    public function getIdPage(): int|null
    {
        return $this->idPage;
    }

    public function setIdPage(int|null $value): void
    {
        $this->idPage = $value;
    }

    public function getPage(): PageVO|null
    {
        return $this->page;
    }

    public function setPage(PageVO|null $value): void
    {
        $this->page = $value;
    }

    public function getMenuParent(): MenuVO|null
    {
        return $this->menuParent;
    }

    public function setMenuParent(MenuVO|null $value): void
    {
        $this->menuParent = $value;
    }

    /**
     * @return MenuVO[]|null
     */
    public function &getSubMenus()
    {
        return $this->subMenus;
    }

    public function setSubMenus(array $subMenus): self
    {
        $this->subMenus = $subMenus;

        return $this;
    }

    /**
     * @return MenuVO
     */
    public function addSubMenus(MenuVO $subMenu): MenuVO
    {
        array_push($this->subMenus, $subMenu);
        $subMenu->setMenuParent($this);

        return $subMenu;
    }

    /**
     * @return MenuVO
     */
    public function removeSubMenus(MenuVO $subMenu): MenuVO
    {
        for ($i = 0; $i < count($this->subMenus); $i++) {
            $item = $this->subMenus[$i];

            if ($item->getId() == $subMenu->getId()){
                unset($this->subMenus[$i]);
                break;
            }
        }
        $subMenu->setMenuParent($this);

        return $subMenu;
    }

    public function isSubMenu(): bool
    {
        return $this->page == null;
    }

    public function getUrl(): string|null
    {
        return $this->page != null ? $this->page->getUrl() : null;
    }

    public function __toString(): string
    {
        return $this->description;
    }

}
