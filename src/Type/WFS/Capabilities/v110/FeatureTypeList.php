<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110;

use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractFeatureTypeList;

/**
 * FeatureTypelist WFS 1.1.0.
 */
class FeatureTypeList extends AbstractFeatureTypeList
{
    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\FeatureType>")
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
    public function getFeatureTypes(): array
    {
        return $this->featureTypes;
    }
}
