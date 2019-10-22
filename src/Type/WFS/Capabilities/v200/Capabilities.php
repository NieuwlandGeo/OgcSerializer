<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractCapabilities;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wfs/2.0")
 * @XmlNamespace(uri="http://www.opengis.net/ows/1.1", prefix="ows")
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
     * @Type("Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\ServiceIdentification")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var ServiceIdentification
     */
    protected $serviceIdentification;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\OperationsMetadata")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var OperationsMetadata
     */
    protected $operationsMetadata;

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
