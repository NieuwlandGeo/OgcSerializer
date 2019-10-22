<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

abstract class AbstractOperation
{
    /** @var string */
    protected $name;

    public function getName(): string
    {
        return $this->name;
    }
}
