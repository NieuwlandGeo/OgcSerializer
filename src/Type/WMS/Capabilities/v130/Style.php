<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\Type;

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
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\LegendURL")
     *
     * @var LegendUrl
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

    public function getLegendURL(): LegendURL
    {
        return $this->legendURL;
    }

    public function setLegendURL(LegendUrl $legendURL): self
    {
        $this->legendURL = $legendURL;

        return $this;
    }
}
