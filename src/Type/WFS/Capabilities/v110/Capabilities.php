<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractCapabilities;

/**
 * Capabilities WFS 1.1.0.
 *
 * @XmlNamespace(uri="http://www.opengis.net/wfs")
 * @XmlNamespace(uri="http://www.opengis.net/ows", prefix="ows")
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
     * @Type("Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\ServiceIdentification")
     * @XmlElement(namespace="http://www.opengis.net/ows")
     *
     * @var ServiceIdentification
     */
    protected $serviceIdentification;

    /**
     * Set the value of featureTypeList.
     */
    public function setFeatureTypeList(FeatureTypeList $featureTypeList): self
    {
        $this->featureTypeList = $featureTypeList;

        return $this;
    }

    public function setServiceIdentification(ServiceIdentification $serviceIdentification): self
    {
        $this->serviceIdentification = $serviceIdentification;

        return $this;
    }
}
