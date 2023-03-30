<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractServiceIdentification;

class ServiceIdentification extends AbstractServiceIdentification
{
    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows")
     *
     * @var string|null
     */
    protected $title;
}
