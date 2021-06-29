<?php

namespace App\Base\Report;

class ReportGroupVO
{
    /**
     * @var string
     */
    private string $group;

    /**
     * @return ReportType[]|null
     */
    private $types = array();

    public function __construct(string $group, array $types)
    {
        $this->group = $group;
        $this->types = $types;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $value): void
    {
        $this->group = $value;
    }

    /**
     * @return ReportType[]|null
     */
    public function &getTypes()
    {
        return $this->types;
    }

    public function setTypes(array $types): self
    {
        $this->types = $types;

        return $this;
    }
}
