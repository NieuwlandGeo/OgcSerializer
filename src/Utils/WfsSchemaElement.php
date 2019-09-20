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
     * @param string   $name          without prefix
     * @param string   $typeName
     * @param string   $typeNamespace
     * @param int|null $minOccurs
     * @param int|null $maxOccurs
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
     * @return int
     */
    public function getMinOccurs(): ?int
    {
        return $this->minOccurs;
    }

    /**
     * Get the value of maxOccurs.
     *
     * @return int
     */
    public function getMaxOccurs(): ?int
    {
        return $this->maxOccurs;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of typeName.
     *
     * @return string
     */
    public function getTypeName(): string
    {
        return $this->typeName;
    }

    /**
     * Get the value of typeNamespace.
     *
     * @return string
     */
    public function getTypeNamespace(): string
    {
        return $this->typeNamespace;
    }
}
