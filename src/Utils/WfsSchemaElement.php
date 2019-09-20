<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Utils;

/**
 * Value object describing a wfs schema element.
 */
class WfsSchemaElement
{
    /** @var int */
    private $minOccurs;
    /** @var int */
    private $maxOccurs;
    /** @var string */
    private $name;
    /** @var string */
    private $typeName;
    /** @var string */
    private $typeNamespace;
    /** @var bool */
    private $nillable;

    /**
     * @param string $name without prefix
     */
    public function __construct(string $name, string $typeName, string $typeNamespace, bool $nillable, ?int $minOccurs = null, ?int $maxOccurs = null)
    {
        $this->minOccurs     = $minOccurs;
        $this->maxOccurs     = $maxOccurs;
        $this->name          = $name;
        $this->typeName      = $typeName;
        $this->typeNamespace = $typeNamespace;
        $this->nillable      = $nillable;
    }

    /**
     * Get the value of minOccurs.
     *
     */
    public function getMinOccurs(): ?int
    {
        return $this->minOccurs;
    }

    /**
     * Get the value of maxOccurs.
     *
     */
    public function getMaxOccurs(): ?int
    {
        return $this->maxOccurs;
    }

    /**
     * Get the value of name.
     *
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of typeName.
     *
     */
    public function getTypeName(): string
    {
        return $this->typeName;
    }

    /**
     * Get the value of typeNamespace.
     *
     */
    public function getTypeNamespace(): string
    {
        return $this->typeNamespace;
    }

    /**
     * Get the value of nillable.
     *
     */
    public function getNillable(): bool
    {
        return $this->nillable;
    }
}
