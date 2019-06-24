<?php

namespace OgcClient\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\Type;

/**
 * @XmlRoot("WMS_Capabilities")
 */
class Capabilities130 extends AbstractCapabilities
{
    /**
     * @var string
     *
     * @Type("string")
     * @XmlAttribute
     */
    protected $version = '1.3.0';
}
