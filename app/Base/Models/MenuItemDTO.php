<?php

namespace App\Base\Models;

class MenuItemDTO
{
    /**
     * @var string
     */
    private string $label;

    /**
     * @var string
     */
    private string $routerLink;

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $to;

    /**
     * @return MenuItemDTO[]|null
     */
    private $items = array();

    public function __construct()
    {
        $this->items = array();
        $this->Clean();
    }

    public function Create(string $label, string $url) {
        $this->label = $label;
        $this->url = $url;
        $this->routerLink = $url;
        $this->to = $url;
    }

    public function CreateWithItems(string $label, string $url, array $items) {
        $this->label = $label;
        $this->url = $url;
        $this->routerLink = $url;
        $this->to = $url;
        $this->items = $items;
    }

    public function Clean(): void
    {
        $this->label = "";
        $this->routerLink = "";
        $this->url = "";
        $this->to = "";
        $this->items = [];
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $value): void
    {
        $this->label = $value;
    }

    public function getRouterLink(): string
    {
        return $this->routerLink;
    }

    public function setRouterLink(string $value): void
    {
        $this->routerLink = $value;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $value): void
    {
        $this->url = $value;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function setTo(string $value): void
    {
        $this->to = $value;
    }

    /**
     * @return MenuItemDTO[]|null
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

}
