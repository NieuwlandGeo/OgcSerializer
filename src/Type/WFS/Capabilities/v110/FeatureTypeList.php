<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110;

use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

/**
 * FeatureTypelist WFS 1.1.0.
 */
class FeatureTypeList extends FeatureTypeList
{
    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\FeatureType110>")
     * @XmlList(inline=true, entry="FeatureType")
     * @AccessType("public_method")
     *
     * @var FeatureType[]
     */
    protected $featureTypes = [];

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
        parent::setFeatureTypes($featureTypes);

        return $this;
    }
}
