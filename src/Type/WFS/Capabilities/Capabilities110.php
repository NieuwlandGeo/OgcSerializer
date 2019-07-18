<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Capabilities WFS 1.1.0.
 *
 * @XmlNamespace(uri="http://www.opengis.net/wfs")
 * @XmlRoot("WFS_Capabilities")
 */
class Capabilities110 extends AbstractCapabilities
{
    /**
     * @Type("Nieuwland\OgcSerializer\Type\WFS\Capabilities\FeatureTypeList110")
     *
     * @var FeatureTypeList
     */
    protected $featureTypeList;

    /**
     * Get the value of featureTypeList.
     *
     * @return FeatureTypeList
     */
    public function getFeatureTypeList()
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
