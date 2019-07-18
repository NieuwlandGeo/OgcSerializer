<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities;

use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\LayerInterface;
use function array_merge;
use function array_unique;

/**
 * WMS Capabilities Layer.
 */
class Layer implements LayerInterface
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
     * @XmlAttribute
     * @Type("bool")
     *
     * @var bool
     */
    private $queryable;

    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="CRS")
     *
     * @var array
     */
    private $crs;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMS\Capabilities\Layer>")
     * @XmlList(inline=true, entry="Layer")
     * @AccessType("public_method")
     *
     * @var Layer[]
     */
    private $layers;

    /**
     * @Exclude
     *
     * @var Layer
     */
    private $parent;

    /**
     * Get the value of queryable.
     *
     * @return bool
     */
    public function getQueryable(): bool
    {
        return $this->queryable;
    }

    /**
     * Set the value of queryable.
     *
     * @param bool $queryable
     *
     * @return self
     */
    public function setQueryable(bool $queryable)
    {
        $this->queryable = $queryable;

        return $this;
    }

    /**
     * Get the value of crs.
     *
     * @return array
     */
    public function getCrs(): ?array
    {
        return $this->crs;
    }

    /**
     * Set the value of crs.
     *
     * @param array $crs
     *
     * @return self
     */
    public function setCrs(array $crs): self
    {
        $this->crs = $crs;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title.
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of layers.
     *
     * @return Layer[]
     */
    public function getLayers()
    {
        return $this->layers;
    }

    /**
     * Set the value of layers.
     *
     * @param Layer[] $layers
     *
     * @return self
     */
    public function setLayers(array $layers)
    {
        /** @var Layer $layer */
        foreach ($layers as $layer) {
            $layer->setParent($this);
        }
        $this->layers = $layers;

        return $this;
    }

    /**
     * Get the value of parent.
     *
     * @return Layer
     */
    public function getParent(): ?Layer
    {
        return $this->parent;
    }

    /**
     * Set the value of parent.
     *
     * @param Layer $parent
     *
     * @return self
     */
    public function setParent(Layer $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @Exclude
     */
    public function getCrsOptions(): array
    {
        $crs = $this->getCrs() ?? [];
        if ($this->getParent()) {
            $crs = array_merge($crs, $this->getParent()->getCrsOptions());
        }

        return array_unique($crs);
    }
}
