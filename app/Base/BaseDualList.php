<?php

namespace App\Base;

use App\Base\Util\IComparable;

class BaseDualList implements IComparable
{

    private $source = array();

    private $target = array();

    public function __construct(array $source, array $target)
    {
        $this->source = $source;
        $this->target = $target;
    }

    public function compare($object): bool
    {
        return $this->__toString() === $object->__toString();
    }

    public function __toString(): string
    {
        return serialize($this);
    }

    public function &getSource()
    {
        return $this->source;
    }

    public function setSource(array $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function &getTarget()
    {
        return $this->target;
    }

    public function setTarget(array $target): self
    {
        $this->target = $target;

        return $this;
    }

}
