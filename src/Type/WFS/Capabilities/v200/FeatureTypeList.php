<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractFeatureTypeList;

/**
 * FeatureTypeList Capabilities 2.0.
 */
class FeatureTypeList extends AbstractFeatureTypeList
{
    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\FeatureType>")
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
}
