<?php

namespace App\Base\Services;

use App\Base\Pagination\PaginationFilter;
use App\Base\Pagination\BasePaged;

interface IBaseCrud {

    public function getPage(string $route, PaginationFilter $filter): BasePaged;

    public function findAll();

    public function findById(int $id);

    public function update(int $id, $obj): bool;

    public function insert($obj);

    public function delete(int $id): bool;

    public function exists(int $id): bool;
}
