<?php

namespace App\Base\Services;

use App\Base\Pagination\PaginationFilter;

interface IUriService {
    public function getPageUri(PaginationFilter $filter, string $route): string;
}
