<?php

namespace App\Base\Pagination;

use Exception;

class BasePaged
{
    private $page = array();

    private BasePaging $paging;

    public function __construct(array $page, BasePaging $paging)
    {
        try
        {
            $paramSort = explode(",",$paging->getPageSort, 2);
            $sortFieldName = "";

            if (count($paramSort) > 0)
            {
                $sortFieldName = strtolower($paramSort[1]);

                if (strtoupper($paramSort[0]) === "ASC")
                {
                    //page = page.OrderBy(s => s.GetType().GetProperty(sortFieldName).GetValue(s)).ToList();
                }
                else
                {
                    //page = page.OrderByDescending(s => s.GetType().GetProperty(sortFieldName).GetValue(s)).ToList();
                }
            }
        }
        catch (Exception $e)
        {
            print("Error Sort BasePaged: " + $e->getMessage());
        }

        $this->setPage($page);
        $this->setPaging($paging);
    }

    public function &getPage()
    {
        return $this->page;
    }

    public function setPage(array $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getPaging(): BasePaging
    {
        return $this->paging;
    }

    public function setPaging(BasePaging $paging): void
    {
        $this->paging = $paging;
    }

}
