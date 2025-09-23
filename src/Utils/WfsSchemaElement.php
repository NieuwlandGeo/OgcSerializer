<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Utils;

/**
 * Value object describing a wfs schema element.
 */
class WfsSchemaElement
{
    private ?string $minOccurs = null;

    private ?string $maxOccurs = null;

    private ?string $name = null;

    private ?string $typeName = null;

    private ?string $typeNamespace = null;

    private ?string $typePrefix = null;

    private ?string $nillable = null;

    /**
     * @param string $name without prefix
     */
    public function __construct(
        string $name,
        string $typeName,
        string $typeNamespace,
        string $typePrefix,
        ?string $nillable = null,
        ?string $minOccurs = null,
        ?string $maxOccurs = null
    ) {
        $this->minOccurs     = $minOccurs;
        $this->maxOccurs     = $maxOccurs;
        $this->name          = $name;
        $this->typeName      = $typeName;
        $this->typeNamespace = $typeNamespace;
        $this->typePrefix    = $typePrefix;
        $this->nillable      = $nillable;
    }

    /**
     * Get the value of minOccurs.
     */
    public function getMinOccurs(): ?string
    {
        return $this->minOccurs;
    }

    /**
     * Get the value of maxOccurs.
     */
    public function getMaxOccurs(): ?string
    {
        return $this->maxOccurs;
    }

    /**
     * Get the value of name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of typeName.
     */
    public function getTypeName(): string
    {
        return $this->typeName;
    }

    /**
     * Get the value of typeNamespace.
     */
    public function getTypeNamespace(): string
    {
        return $this->typeNamespace;
    }

    /**
     * Get the type prefix.
     */
    public function getTypePrefix(): string
    {
        return $this->typePrefix;
    }

    /**
     * Get the value of nillable.
     */
    public function getNillable(): ?string
    {
        return $this->nillable;
    }
}
