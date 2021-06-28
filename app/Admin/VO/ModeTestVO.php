<?php

namespace App\Admin\VO;

use App\Base\Util\IComparable;

class ModeTestVO implements IComparable
{
    /**
     * @var bool
     */
    public bool $active;

    /**
     * @var string
     */
    public string $login;

    /**
     * @var string
     */
    public string $loginVirtual;

    public function __construct()
    {
        $this->Active = false;
        $this->Login = "";
        $this->LoginVirtual = "";
    }

    public function Create(bool $active, string $login, string $loginVirtual)
    {
        $this->active = $active;
        $this->login = $login;
        $this->loginVirtual = $loginVirtual;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $value): void
    {
        $this->active = $value;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $value): void
    {
        $this->login = $value;
    }

    public function getLoginVirtual(): string
    {
        return $this->loginVirtual;
    }

    public function setLoginVirtual(string $value): void
    {
        $this->loginVirtual = $value;
    }

    public function compare($object): bool
    {
        return $this->__toString() === $object->__toString();
    }

    public function __toString(): string
    {
        //return "ModeTestVO [active=" . $this->active . ", login=" . $this->login . ", loginVirtual=" . $this->loginVirtual . "]";
        return serialize($this);
    }
}
