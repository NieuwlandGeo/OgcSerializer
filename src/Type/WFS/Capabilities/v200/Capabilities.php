<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractCapabilities;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractFeatureTypeList;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wfs/2.0")
 * @XmlRoot("WFS_Capabilities")
 */
class Capabilities extends AbstractCapabilities
{
    /**
     * @Type("Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\FeatureTypeList")
     *
     * @var FeatureTypeList
     */
    protected $featureTypeList;

    /**
     * Get the value of featureTypeList.
     *
     * @return FeatureTypeList
     */
    public function getFeatureTypeList(): AbstractFeatureTypeList
    {
        return $this->featureTypeList;
    }

    /**
     * Set the value of featureTypeList.
     *
     * @param FeatureTypeList $featureTypeList
     *
     * @return self
     */
    public function setFeatureTypeList(FeatureTypeList $featureTypeList)
    {
        $this->featureTypeList = $featureTypeList;

        return $this;
    }
}
