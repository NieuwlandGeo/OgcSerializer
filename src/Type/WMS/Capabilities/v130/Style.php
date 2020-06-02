<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

/**
 * Base on WMS 1.3.0 style.
 */
class Style
{
    /**
     * @Type("string")
     *
     * @var string
     */
    private $name;

    /**
     * @Type("string")
     *
     * @var string
     */
    private $title;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\LegendURL>")
     * @XmlList(inline=true, entry="LegendURL", namespace="http://www.opengis.net/wms")
     *
     * @var LegendURL[]
     */
    private $legendURL;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return LegendURL[]|null
     */
    public function getLegendURL(): ?array
    {
        return $this->legendURL;
    }

    /**
     * @param LegendURL[] $legendURL
     */
    public function setLegendURL(array $legendURL): self
    {
        $this->legendURL = $legendURL;

        return $this;
    }
}
