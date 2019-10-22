<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractOperationsMetadata;

class OperationsMetadata extends AbstractOperationsMetadata
{
    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\Operation>")
     * @XmlList(inline=true, entry="Operation", namespace="http://www.opengis.net/ows")
     *
     * @var Operation[]
     */
    protected $operations;
}
