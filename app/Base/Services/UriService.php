<?php

namespace App\Base\Services;

use App\Base\Pagination\PaginationFilter;

class UriService implements IUriService
{
    private string $baseUri;

    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function getPageUri(PaginationFilter $filter, string $route): string
    {
        $enpointUri = $this->baseUri . "/" . $route;
        $modifiedUri = $enpointUri . "?pageNumber=" . $filter->getPageNumber();
        $modifiedUri = $modifiedUri . "&size=" . $filter->getSize();
        $modifiedUri = $modifiedUri . "&sort=" . $filter->getSort();
        $modifiedUri = $modifiedUri . "&columnOrder=" . $filter->getColumnOrder();
        $modifiedUri = $modifiedUri . "&columnTitle=" . $filter->getColumnTitle();

        return $modifiedUri;
    }
}
