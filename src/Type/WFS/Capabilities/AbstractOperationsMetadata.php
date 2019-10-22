<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

abstract class AbstractOperationsMetadata
{
    /** @var AbstractOperation[] */
    protected $operations;

    /**
     * @return AbstractOperation[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }
}
