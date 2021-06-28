<?php

namespace App\Base\Pagination;

class BasePageItemBuilder
{
    /**
     * @var int
     */
    private int $pageItemType;

    /**
     * @var int
     */
    private int $index;

    /**
     * @var bool
     */
    private bool $active;

    public function pageItemType(int $pageItemType): BasePageItemBuilder
    {
        $this->pageItemType = $pageItemType;
        return $this;
    }

    public function index(int $index): BasePageItemBuilder
    {
        $this->index = $index;
        return $this;
    }

    public function active(bool $active): BasePageItemBuilder
    {
        $this->active = $active;
        return $this;
    }

    public function build(): BasePageItem
    {
        return new BasePageItem($this->pageItemType, $this->index, $this->active);
    }
}

class BasePageItem
{
    /**
     * @var int
     */
    private int $pageItemType;

    /**
     * @var int
     */
    private int $index;

    /**
     * @var bool
     */
    private bool $active;

    public function __construct(int $pageItemType, int $index, bool $active)
    {
        $this->pageItemType = $pageItemType;
        $this->index = $index;
        $this->active = $active;
    }

    public static function builder(): BasePageItemBuilder
    {
        return new BasePageItemBuilder();
    }
}
