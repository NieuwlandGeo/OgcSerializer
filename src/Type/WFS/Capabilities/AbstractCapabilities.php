<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WFS\Capabilities;

use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * @XmlNamespace(uri="http://www.opengis.net/wfs/2.0")
 * @XmlRoot("WFS_Capabilities")
 */
abstract class AbstractCapabilities
{
    private $featureTypeList;
}
