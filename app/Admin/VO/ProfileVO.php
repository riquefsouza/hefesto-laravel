<?php

namespace App\Admin\VO;

use DateTime;

class ProfileVO
{
    /**
     * @var int
     */
    private int $id;

    public function __construct()
    {
        $this->Clean();
    }

}
