<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractCapabilities;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractFeatureTypeList;

/**
 * Capabilities WFS 1.1.0.
 *
 * @XmlNamespace(uri="http://www.opengis.net/wfs")
 * @XmlRoot("WFS_Capabilities")
 */
class Capabilities extends AbstractCapabilities
{
    /**
     * @Type("Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\FeatureTypeList")
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
     *
     */
    public function setFeatureTypeList(FeatureTypeList $featureTypeList): self
    {
        $this->featureTypeList = $featureTypeList;

        return $this;
    }
}
