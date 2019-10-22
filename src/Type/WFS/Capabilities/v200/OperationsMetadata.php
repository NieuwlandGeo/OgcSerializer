<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractOperationsMetadata;

class OperationsMetadata extends AbstractOperationsMetadata
{
    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Operation>")
     * @XmlList(inline=true, entry="Operation", namespace="http://www.opengis.net/ows/1.1")
     *
     * @var Operation[]
     */
    protected $operations;
}
