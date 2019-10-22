<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\WFS\Capabilities\AbstractOperation;

class Operation extends AbstractOperation
{
    /**
     * @var string
     *
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("name")
     */
    protected $name;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WFS\Capabilities\v110\Parameter>")
     * @XmlList(inline=true, entry="Parameter", namespace="http://www.opengis.net/ows")
     *
     * @var Parameter[]
     */
    protected $parameters;

    /**
     * @param Parameter[] $parameters
     */
    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @return Parameter[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}
