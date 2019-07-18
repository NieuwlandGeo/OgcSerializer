<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

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
