<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

use JMS\Serializer\Annotation\Type;
use Nieuwland\OgcSerializer\Type\LayerInterface;

abstract class AbstractFeatureType implements LayerInterface
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
     * Get the value of name.
     *
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     *
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of title.
     *
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title.
     *
     *
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getCrsOptions(): array;

    /**
     * Get de default Crs.
     */
    abstract public function getDefaultCrs(): string;
}
