<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Utils;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class WfsSchema implements IteratorAggregate
{
    private string $namespaceUri = '';

    /** @var WfsSchemaElement[] */
    private array $elements = [];

    public function setNamespaceUri(string $namespaceUri): self
    {
        $this->namespaceUri = $namespaceUri;

        return $this;
    }

    public function getNamespaceUri() : string
    {
        return $this->namespaceUri;
    }

    public function addElement(WfsSchemaElement $element): void
    {
        $this->elements[] = $element;
    }

    /**
     *
     * @return WfsSchemaElement[]
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }
}
