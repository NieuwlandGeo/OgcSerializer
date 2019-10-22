<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

class AllowedValues
{
    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="Value", namespace="http://www.opengis.net/ows/1.1")
     *
     * @var string[]
     */
    protected $values;

    /**
     * @return string[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param string[] $values
     */
    public function setValues(array $values): self
    {
        $this->values = $values;

        return $this;
    }
}
