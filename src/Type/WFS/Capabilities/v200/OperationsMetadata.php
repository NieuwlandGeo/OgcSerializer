<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractOperationsMetadata;

class OperationsMetadata extends AbstractOperationsMetadata
{
    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\Operation>")
     * @XmlList(inline=true, entry="Operation", namespace="http://www.opengis.net/ows/1.1")
     * @AccessType("public_method")
     *
     * @var Operation[]
     */
    protected $operations;

    public function getOperation(string $name): Operation
    {
        return $this->operations[$name];
    }

    /**
     * @return Operation[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }
}
