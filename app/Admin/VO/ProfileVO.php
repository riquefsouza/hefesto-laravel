<?php

namespace App\Admin\VO;

use DateTime;

class ProfileVO
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var bool|null
     */
    private bool|null $administrator;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var bool|null
     */
    public bool|null $general;

    /**
     * @var bool
     */
    public bool $intersection;

    /**
     * @return PageVO[]|null
     */
    public $pages = array();

    /**
     * @return UserVO[]|null
     */
    public $users = array();

    /**
     * @return UserVO[]|null
     */
    public $excludedUsers = array();


    public function __construct()
    {
        $this->pages = array();
        $this->users = array();
        $this->excludedUsers = array();
        $this->Clean();
    }

    public function Clean(): void
    {
        $this->id = -1;
        $this->administrator = false;
        $this->description = "";
        $this->general = false;
        $this->intersection = false;
        $this->pages = [];
        $this->users = [];
        $this->excludedUsers = [];
    }

    public function __toString(): string
    {
        return $this->description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function getAdministrator(): bool|null
    {
        return $this->administrator;
    }

    public function setAdministrator(bool|null $value): void
    {
        $this->administrator = $value;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $value): void
    {
        $this->description = $value;
    }

    public function getGeneral(): bool|null
    {
        return $this->general;
    }

    public function setGeneral(bool|null $value): void
    {
        $this->general = $value;
    }

    public function getIntersection(): bool
    {
        return $this->intersection;
    }

    public function setIntersection(bool $value): void
    {
        $this->intersection = $value;
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
     * @return UserVO[]|null
     */
    public function &getUsers()
    {
        return $this->users;
    }

    public function setUsers(array $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return UserVO[]|null
     */
    public function &getExcludedUsers()
    {
        return $this->excludedUsers;
    }

    public function setExcludedUsers(array $excludedUsers): self
    {
        $this->excludedUsers = $excludedUsers;

        return $this;
    }
}
