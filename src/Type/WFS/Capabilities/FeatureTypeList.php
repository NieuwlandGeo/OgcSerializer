<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WFS\Capabilities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

class FeatureTypeList
{
    /**
     * @Type("array<OgcSerializer\Type\WFS\Capabilities\FeatureType>")
     * @XmlList(inline=true, entry="FeatureType")
     *
     * @var FeatureType[]
     */
    private $featureTypes = [];

    /**
     * Get the value of featureTypes.
     *
     * @return FeatureType[]
     */
    public function getFeatureTypes()
    {
        return $this->featureTypes;
    }

    /**
     * Set the value of featureTypes.
     *
     * @param FeatureType[] $featureTypes
     *
     * @return self
     */
    public function setFeatureTypes(array $featureTypes)
    {
        $this->featureTypes = $featureTypes;

        return $this;
    }
}
