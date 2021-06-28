<?php

namespace App\Base\Pagination;

use App\Base\Services\IUriService;
use App\Base\Pagination\BasePageItem;
use App\Base\Pagination\BasePageItemType;

const PAGINATION_STEP = 3;

class BasePaging
{
    private bool $nextEnabled;
    private bool $prevEnabled;
    private int $pageSize;
    private int $pageNumber;

    private string $pageSort;
    private int $columnOrder;
    private string $columnTitle;

    /**
     * @return BasePageItem[]|null
     */
    private $items = array();

    private int $totalRecords;
    private string $firstPage;
    private string $lastPage;
    private string $nextPage;
    private string $previousPage;

    private string $nextEnabledClass;
    private string $prevEnabledClass;

    private PaginationFilter $validFilter;
    private IUriService $uriService;
    private string $route;

    public function __construct(PaginationFilter $validFilter, IUriService $uriService, string $route)
    {
        $this->validFilter = $validFilter;
        $this->uriService = $uriService;
        $this->route = $route;

        $this->totalRecords = 0;
        $items = array();
    }

    public function Create(bool $nextEnabled, bool $prevEnabled, int $pageSize, int $pageNumber,
        string $pageSort, int $columnOrder, string $columnTitle, array $items)
    {
        $this->NextEnabled = $nextEnabled;
        $this->PrevEnabled = $prevEnabled;
        $this->PageSize = $pageSize;
        $this->PageNumber = $pageNumber;

        $this->PageSort = $pageSort;
        $this->ColumnOrder = $columnOrder;
        $this->ColumnTitle = $columnTitle;

        $this->Items = $items;
    }

    public function getCurrentPage(int $pageNumber): string
    {
        return $this->uriService->getPageUri(new PaginationFilter($this->pageNumber,
            $this->validFilter->getSize(), $this->validFilter->getSort(),
            $this->validFilter->getColumnOrder(), $this->validFilter->getColumnTitle()), $this->route);
    }

    public function addPageItems(int $from, int $to, int $pageNumber): void
    {
        for ($i = $from; $i <= $to; $i++)
        {
            array_push($this->items,
                BasePageItem::builder()->active($pageNumber != $i)->index($i)
                    ->pageItemType(BasePageItemType::PAGE)->build());
        }
    }

    public function last(int $pageSize): void
    {
        array_push($this->items,
            BasePageItem::builder()->active(false)
                ->pageItemType(BasePageItemType::DOTS)->build());

        array_push($this->items,
            BasePageItem::builder()->active(true)->index($pageSize)
                ->pageItemType(BasePageItemType::PAGE)->build());
    }

    public function first(int $pageNumber): void
    {
        array_push($this->items,
            BasePageItem::builder()->active($pageNumber != 1)->index(1)
                ->pageItemType(BasePageItemType::PAGE)->build());

        array_push($this->items,
            BasePageItem::builder()->active(false)
                ->pageItemType(BasePageItemType::DOTS)->build());
    }

    public static function of(PaginationFilter $validFilter, int $totalRecords,
        IUriService $uriService, string $route): BasePaging
    {
        $paging = new BasePaging($validFilter, $uriService, $route);

        $totalPages = ((float)$totalRecords / (float)$validFilter->getSize());

        $roundedTotalPages = intval(ceil($totalPages));

        $paging->nextPage =
            $validFilter->getPageNumber() >= 1 && $validFilter->getPageNumber() < $roundedTotalPages
            ? $uriService->getPageUri(new PaginationFilter($validFilter->getPageNumber() + 1, $validFilter->getSize(),
                $validFilter->getSort(), $validFilter->getColumnOrder(), $validFilter->getColumnTitle()), $route)
            : null;
        $paging->previousPage =
            $validFilter->getPageNumber() - 1 >= 1 && $validFilter->getPageNumber() <= $roundedTotalPages
            ? $uriService->getPageUri(new PaginationFilter($validFilter->getPageNumber() - 1, $validFilter->getSize(),
                $validFilter->getSort(), $validFilter->getColumnOrder(), $validFilter->getColumnTitle()), $route)
            : null;
        $paging->firstPage = $uriService->getPageUri(new PaginationFilter(1, $validFilter->getSize(),
            $validFilter->getSort(), $validFilter->getColumnOrder(), $validFilter->getColumnTitle()), $route);
        $paging->lastPage = $uriService->getPageUri(new PaginationFilter($roundedTotalPages, $validFilter->getSize(),
            $validFilter->getSort(), $validFilter->getColumnOrder(), $validFilter->getColumnTitle()), $route);

        $paging->setTotalRecords($totalRecords);

        $paging->setPageSize($validFilter->getsize());
        $paging->setNextEnabled = $validFilter->getPageNumber() != $roundedTotalPages;
        $paging->setPrevEnabled = $validFilter->getPageNumber() != 1;
        $paging->setPageNumber = $validFilter->getPageNumber();

        $paging->setNextEnabledClass = $paging->NextEnabled ? "page-item" : "page-item disabled";
        $paging->setPrevEnabledClass = $paging->PrevEnabled ? "page-item" : "page-item disabled";

        $paging->setPageSort = $validFilter->getSort();
        $paging->setColumnOrder = $validFilter->getColumnOrder();
        $paging->setColumnTitle = $validFilter->getColumnTitle();


        if ($totalPages < PAGINATION_STEP * 2 + 6)
        {
            $paging->addPageItems(1, $roundedTotalPages + 1, $validFilter->getPageNumber());

        }
        else if ($validFilter->getPageNumber() < PAGINATION_STEP * 2 + 1)
        {
            $paging->addPageItems(1, PAGINATION_STEP * 2 + 4, $validFilter->getPageNumber());
            $paging->last($roundedTotalPages);

        }
        else if ($validFilter->getPageNumber() > $roundedTotalPages - PAGINATION_STEP * 2)
        {
            $paging->first($validFilter->getPageNumber());
            $paging->addPageItems($roundedTotalPages - PAGINATION_STEP * 2 - 2, $roundedTotalPages + 1,
                $validFilter->getPageNumber());

        }
        else
        {
            $paging->first($validFilter->getPageNumber());
            $paging->addPageItems($validFilter->getPageNumber() - PAGINATION_STEP,
                $validFilter->getPageNumber() + PAGINATION_STEP + 1, $validFilter->getPageNumber());
            $paging->last($roundedTotalPages);
        }

        return $paging;
    }

    public function getNextEnabled(): bool
    {
        return $this->nextEnabled;
    }

    public function setNextEnabled(bool $value): void
    {
        $this->nextEnabled = $value;
    }

    public function getPrevEnabled(): bool
    {
        return $this->prevEnabled;
    }

    public function setPrevEnabled(bool $value): void
    {
        $this->prevEnabled = $value;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function setPageSize(int $value): void
    {
        $this->pageSize = $value;
    }

    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(int $value): void
    {
        $this->pageNumber = $value;
    }

    public function getPageSort(): string
    {
        return $this->pageSort;
    }

    public function setPageSort(string $value): void
    {
        $this->pageSort = $value;
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

    /**
     * @return BasePageItem[]|null
     */
    public function &getItems()
    {
        return $this->items;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function getTotalRecords(): int
    {
        return $this->totalRecords;
    }

    public function setTotalRecords(int $value): void
    {
        $this->totalRecords = $value;
    }

    public function getFirstPage(): string
    {
        return $this->firstPage;
    }

    public function setFirstPage(string $value): void
    {
        $this->firstPage = $value;
    }

    public function getLastPage(): string
    {
        return $this->lastPage;
    }

    public function setLastPage(string $value): void
    {
        $this->lastPage = $value;
    }

    public function getNextPage(): string
    {
        return $this->nextPage;
    }

    public function setNextPage(string $value): void
    {
        $this->nextPage = $value;
    }

    public function getPreviousPage(): string
    {
        return $this->previousPage;
    }

    public function setPreviousPage(string $value): void
    {
        $this->previousPage = $value;
    }


    public function getNextEnabledClass(): string
    {
        return $this->nextEnabledClass;
    }

    public function setNextEnabledClass(string $value): void
    {
        $this->nextEnabledClass = $value;
    }

    public function getPrevEnabledClass(): string
    {
        return $this->prevEnabledClass;
    }

    public function setPrevEnabledClass(string $value): void
    {
        $this->prevEnabledClass = $value;
    }

}
