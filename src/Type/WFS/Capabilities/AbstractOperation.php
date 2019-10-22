<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

abstract class AbstractOperation
{
    /** @var string */
    protected $name;

    /** @var AbstractParameter[] */
    protected $parameters;

    /**
     * Get the value of parameters.
     *
     * @return AbstractParameter[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
