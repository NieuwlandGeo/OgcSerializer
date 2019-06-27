<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WFS\Capabilities;

class FeatureTypeList
{
    /**
     * @Type("array<OgcSerializer\Type\WFS\Capabilities\FeatureType>")
     *
     * @var FeatureType[]
     */
    private $featureTypes;

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
    public function setFeatureTypes($featureTypes)
    {
        $this->featureTypes = $featureTypes;

        return $this;
    }
}
