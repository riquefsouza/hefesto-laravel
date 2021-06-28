<?php

namespace App\Base\Pagination;

class PaginationFilter
{
    /**
     * @var int
     */
    private int $pageNumber;

    /**
     * @var int
     */
    private int $size;

    /**
     * @var string
     */
    private string $sort;

    /**
     * @var int
     */
    private int $columnOrder;

    /**
     * @var string
     */
    private string $columnTitle;

    public function __construct()
    {
        $this->pageNumber = 1;
        $this->size = 10;
        $this->sort = "ASC,id";
        $this->columnOrder = 0;
        $this->columnTitle = "id";
    }

    public function Create(int $pageNumber, int $size, string $sort, int $columnOrder, string $columnTitle)
    {
        $this->pageNumber = $pageNumber < 1 ? 1 : $pageNumber;
        $this->size = $size < 10 ? 10 : $size;
        $this->sort = strlen(trim($sort)) == 0 ? "ASC, id" : $sort;
        $this->columnOrder = $columnOrder < 0 ? 0 : $columnOrder;
        $this->columnTitle = strlen(trim($columnTitle)) == 0 ? "id" : $columnTitle;
    }

    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(int $value): void
    {
        $this->pageNumber = $value;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $value): void
    {
        $this->size = $value;
    }

    public function getSort(): string
    {
        return $this->sort;
    }

    public function setSort(string $value): void
    {
        $this->sort = $value;
    }

    public function getColumnOrder(): int
    {
        return $this->columnOrder;
    }

    public function setColumnOrder(int $value): void
    {
        $this->columnOrder = $value;
    }

    public function getColumnTitle(): string
    {
        return $this->columnTitle;
    }

    public function setColumnTitle(string $value): void
    {
        $this->columnTitle = $value;
    }


}
