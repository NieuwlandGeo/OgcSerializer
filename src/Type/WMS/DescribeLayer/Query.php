<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WMS\DescribeLayer;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;

class Query
{
    /**
     * @Type("string")
     * @XmlAttribute()
     *
     * @var string
     */
    private $typeName;

    /**
     * Get the value of typeName
     *
     * @return  string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Set the value of typeName
     *
     * @param  string $typeName
     *
     * @return  self
     */
    public function setTypeName(string $typeName)
    {
        $this->typeName = $typeName;

        return $this;
    }
}
