<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

abstract class AbstractOperationsMetadata
{
    /** @var AbstractOperation[] */
    protected $operations;

    /**
     * @param AbstractOperation[] $operations
     */
    public function setOperations(array $operations): self
    {
        foreach ($operations as $operation) {
            $this->operations[$operation->getName()] = $operation;
        }

        return $this;
    }
}
