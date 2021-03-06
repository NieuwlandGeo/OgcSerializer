<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\DescribeLayer;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

class Query
{
    /**
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("typeName")
     *
     * @var string
     */
    private $typeName;

    /**
     * Get the value of typeName.
     *
     */
    public function getTypeName(): string
    {
        return $this->typeName;
    }

    /**
     * Set the value of typeName.
     *
     *
     */
    public function setTypeName(string $typeName): self
    {
        $this->typeName = $typeName;

        return $this;
    }
}
