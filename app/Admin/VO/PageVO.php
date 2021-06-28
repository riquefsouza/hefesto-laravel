<?php

namespace App\Admin\VO;

class PageVO
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
     * @var string
     */
    private string $url;

    /**
     * @return ProfileVO[]|null
     */
    public $profiles = array();

    public function __construct()
    {
        $this->profiles = array();
        $this->Clean();
    }

    public function Clean(): void
    {
        $this->id = -1;
        $this->description = "";
        $this->url = "";
        $this->profiles = [];
    }

    public function __toString(): string
    {
        return $this->url;
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

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $value): void
    {
        $this->url = $value;
    }

    /**
     * @return ProfileVO[]|null
     */
    public function &getProfiles()
    {
        return $this->profiles;
    }

    public function setProfiles(array $profiles): self
    {
        $this->profiles = $profiles;

        return $this;
    }

}
