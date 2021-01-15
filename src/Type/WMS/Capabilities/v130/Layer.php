<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;
use Nieuwland\OgcSerializer\Type\LayerInterface;
use Nieuwland\OgcSerializer\Type\StyleInterface;
use Symfony\Component\Validator\Constraints as Assert;

use function array_merge;
use function array_unique;
use function assert;
use function explode;
use function is_numeric;
use function pow;
use function strpos;

/**
 * WMS Capabilities Layer.
 */
class Layer implements LayerInterface, StyleInterface
{
    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var string
     */
    private $name;

    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var string
     *
     * @Assert\NotNull
     */
    private $title;

    /**
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var string
     */
    private $abstract;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Style>")
     * @XmlList(inline=true, entry="Style", namespace="http://www.opengis.net/wms")
     *
     * @var Style[]
     */
    private $styles;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\ExGeographicBoundingBox")
     * @SerializedName("EX_GeographicBoundingBox")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var ExGeographicBoundingBox
     */
    private $exGeographicBoundingBox;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\BoundingBox>")
     * @XmlList(inline=true, entry="BoundingBox", namespace="http://www.opengis.net/wms")
     *
     * @var BoundingBox[]
     */
    private $boundingBoxes;

    /**
     * @XmlAttribute
     * @Type("bool")
     *
     * @var bool
     */
    private $queryable = false;

    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="CRS", namespace="http://www.opengis.net/wms")
     *
     * @var string[]
     */
    private $crs;

    /**
     * @Type("float")
     * @AccessType("public_method")
     *
     * @var float
     */
    private $minScaleDenominator;

    /**
     * @Type("float")
     * @AccessType("public_method")
     *
     * @var float
     */
    private $maxScaleDenominator;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Layer>")
     * @XmlList(inline=true, entry="Layer", namespace="http://www.opengis.net/wms")
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

    public function getQueryable(): bool
    {
        return $this->queryable;
    }

    public function setQueryable(bool $queryable): self
    {
        $this->queryable = $queryable;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getCrs(): ?array
    {
        return $this->crs;
    }

    /**
     * @param string[] $crs
     */
    public function setCrs(array $crs): self
    {
        $this->crs = $crs;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Layer[]
     */
    public function getLayers(): array
    {
        return $this->layers;
    }

    /**
     * @param Layer[] $layers
     */
    public function setLayers(array $layers): self
    {
        foreach ($layers as $layer) {
            assert($layer instanceof Layer);
            $layer->setParent($this);
        }

        $this->layers = $layers;

        return $this;
    }

    public function getParent(): ?Layer
    {
        return $this->parent;
    }

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

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * @return Style[]
     */
    public function getStyles(): array
    {
        return $this->styles;
    }

    /**
     * Get all style options, including inherited.
     *
     * @Exclude
     *
     * @return Style[]
     */
    public function getStyleOptions(): array
    {
        $styles = $this->getStyles() ?? [];
        if ($this->getParent()) {
            $styles = array_merge($styles, $this->getParent()->getStyleOptions());
        }

        return $styles;
    }

    /**
     * {@inheritdoc}
     */
    public function getStyleNames(): array
    {
        $names = [];
        foreach ($this->getStyleOptions() as $style) {
            $names[$style->getName()] = $style->getTitle();
        }

        return $names;
    }

    /**
     * Get style by name.
     */
    public function getStyle(string $name): ?Style
    {
        foreach ($this->getStyleOptions() as $style) {
            if ($style->getName() === $name) {
                return $style;
            }
        }

        return null;
    }

    /**
     * @param Style[] $styles
     */
    public function setStyles(array $styles): self
    {
        $this->styles = $styles;

        return $this;
    }

    public function getExGeographicBoundingBox(): ?ExGeographicBoundingBox
    {
        return $this->exGeographicBoundingBox;
    }

    /**
     * Get optional inherited EX_GeographicBoundingBox.
     *
     * @Exclude
     */
    public function getExGeographicBoundingBoxOption(): ?ExGeographicBoundingBox
    {
        if ($this->getExGeographicBoundingBox()) {
            return $this->getExGeographicBoundingBox();
        }

        if ($this->getParent() && $this->getParent()->getExGeographicBoundingBoxOption()) {
            return $this->getParent()->getExGeographicBoundingBoxOption();
        }

        return null;
    }

    public function setExGeographicBoundingBox(ExGeographicBoundingBox $exGeographicBoundingBox): self
    {
        $this->exGeographicBoundingBox = $exGeographicBoundingBox;

        return $this;
    }

    /**
     * @return BoundingBox[]|null
     */
    public function getBoundingBoxes(): ?array
    {
        return $this->boundingBoxes;
    }

    /**
     * Get (inherited) bounding box.
     *
     * @return BoundingBox[]|null
     */
    public function getBoundingBoxOptions(): ?array
    {
        if ($this->getBoundingBoxes()) {
            return $this->getBoundingBoxes();
        }

        if ($this->getParent()) {
            return $this->getParent()->getBoundingBoxOptions();
        }

        return null;
    }

    public function getBoundingBoxOption(string $crs): ?BoundingBox
    {
        foreach ($this->getBoundingBoxOptions() as $bbox) {
            if ($bbox->getCrs() === $crs) {
                return $bbox;
            }
        }

        return null;
    }

    /**
     * @param BoundingBox[] $boundingBoxes
     */
    public function setBoundingBoxes(array $boundingBoxes): self
    {
        $this->boundingBoxes = $boundingBoxes;

        return $this;
    }

    public function getMinScaleDenominator(): ?float
    {
        return $this->minScaleDenominator;
    }

    /**
     * @param mixed $minScaleDenominator
     */
    public function setMinScaleDenominator($minScaleDenominator): self
    {
        $this->minScaleDenominator = $this->readScaleDenominator($minScaleDenominator);

        return $this;
    }

    public function getMaxScaleDenominator(): ?float
    {
        return $this->maxScaleDenominator;
    }

    public function setMaxScaleDenominator(float $maxScaleDenominator): self
    {
        $this->maxScaleDenominator = $this->readScaleDenominator($maxScaleDenominator);

        return $this;
    }

    /**
     * Get flat array of layernames of all children.
     *
     * @return string[]
     */
    public function getLayerNames(): array
    {
        if (! $this->getLayers()) {
            return [];
        }

        $names = [];
        foreach ($this->getLayers() as $layer) {
            if ($layer->getLayerNames()) {
                $names = array_merge($names, $layer->getLayerNames());
            }

            if (! $layer->getName()) {
                continue;
            }

            $names[] = $layer->getName();
        }

        return $names;
    }

    /**
     * Find (child) layer by name.
     *
     * @Exclude
     */
    public function getLayerByName(string $name): ?Layer
    {
        if ($this->getName() === $name) {
            return $this;
        }

        if (! $this->getLayers()) {
            return null;
        }

        foreach ($this->getLayers() as $layer) {
            $namedLayer = $layer->getLayerByName($name);
            if ($namedLayer) {
                return $namedLayer;
            }
        }

        return null;
    }

    /**
     * Transforms scale denominator to float.
     *
     * @param mixed $denominator
     */
    private function readScaleDenominator($denominator): ?float
    {
        if (is_numeric($denominator)) {
            return $denominator;
        }

        if (strpos($denominator, 'e')) {
            [$base, $exp] = explode('e', $denominator);

            return pow($base, $exp);
        }

        return null;
    }
}
