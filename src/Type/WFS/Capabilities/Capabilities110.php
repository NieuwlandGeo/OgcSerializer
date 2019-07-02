<?php

declare(strict_types=1);

namespace OgcSerializer\Type\WFS\Capabilities;

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
}
