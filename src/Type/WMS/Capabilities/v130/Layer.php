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
use function array_merge;
use function array_unique;
use function explode;
use function is_numeric;
use function pow;
use function strpos;

/**
 * WMS Capabilities Layer.
 */
class Layer implements LayerInterface
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
    private $queryable;

    /**
     * @Type("array<string>")
     * @XmlList(inline=true, entry="CRS")
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

    /**
     * Get the value of queryable.
     */
    public function getQueryable(): bool
    {
        return $this->queryable;
    }

    /**
     * Set the value of queryable.
     */
    public function setQueryable(bool $queryable): self
    {
        $this->queryable = $queryable;

        return $this;
    }

    /**
     * Get the value of crs.
     *
     * @return string[]
     */
    public function getCrs(): ?array
    {
        return $this->crs;
    }

    /**
     * Set the value of crs.
     *
     * @param string[] $crs
     */
    public function setCrs(array $crs): self
    {
        $this->crs = $crs;

        return $this;
    }

    /**
     * Get the value of name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of title.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title.
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of layers.
     *
     * @return Layer[]
     */
    public function getLayers(): array
    {
        return $this->layers;
    }

    /**
     * Set the value of layers.
     *
     * @param Layer[] $layers
     */
    public function setLayers(array $layers): self
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
     */
    public function getParent(): ?Layer
    {
        return $this->parent;
    }

    /**
     * Set the value of parent.
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

    /**
     * Get the value of abstract.
     */
    public function getAbstract(): string
    {
        return $this->abstract;
    }

    /**
     * Set the value of abstract.
     */
    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get the value of styles.
     *
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
            $crs = array_merge($styles, $this->getParent()->getStyleOptions());
        }

        return array_unique($styles);
    }

    /**
     * Undocumented function.
     *
     * @return string[]
     */
    public function getStyleNames(): array
    {
        $names = [];
        foreach ($this->getStyleOptions() as $style) {
            $names[] = $style->getName();
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
     * Set the value of styles.
     *
     * @param Style[] $styles
     */
    public function setStyles(array $styles): self
    {
        $this->styles = $styles;

        return $this;
    }

    /**
     * Get undocumented variable.
     */
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

    /**
     * Set undocumented variable.
     *
     * @param ExGeographicBoundingBox $exGeographicBoundingBox undocumented variable
     */
    public function setExGeographicBoundingBox(ExGeographicBoundingBox $exGeographicBoundingBox): self
    {
        $this->exGeographicBoundingBox = $exGeographicBoundingBox;

        return $this;
    }

    /**
     * Get the value of boundingBoxes.
     *
     * @return BoundingBox[]
     */
    public function getBoundingBoxes(): array
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
     * Set the value of boundingBoxes.
     *
     * @param BoundingBox[] $boundingBoxes
     */
    public function setBoundingBoxes(array $boundingBoxes): self
    {
        $this->boundingBoxes = $boundingBoxes;

        return $this;
    }

    /**
     * Get the value of minScaleDenominator.
     */
    public function getMinScaleDenominator(): ?float
    {
        return $this->minScaleDenominator;
    }

    /**
     * Set the value of minScaleDenominator.
     *
     * @param mixed $minScaleDenominator
     */
    public function setMinScaleDenominator($minScaleDenominator): self
    {
        $this->minScaleDenominator = $this->readScaleDenominator($minScaleDenominator);

        return $this;
    }

    /**
     * Get the value of maxScaleDenominator.
     */
    public function getMaxScaleDenominator(): ?float
    {
        return $this->maxScaleDenominator;
    }

    /**
     * Set the value of maxScaleDenominator.
     *
     * @param mixed $maxScaleDenominator
     */
    public function setMaxScaleDenominator($maxScaleDenominator): self
    {
        $this->maxScaleDenominator = $this->readScaleDenominator($maxScaleDenominator);

        return $this;
    }

    /**
     * Get flat array of layernames of all children.
     *
     * @return string[]|null
     */
    public function getLayerNames(): ?array
    {
        if (! $this->getLayers()) {
            return null;
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
     * @param mixed $denominator
     */
    private function readScaleDenominator($denominator): ?float
    {
        if (is_numeric($denominator)) {
            return $denominator;
        }
        if (strpos($denominator, 'e')) {
            [$base,$exp] = explode('e', $denominator);

            return pow($base, $exp);
        }

        return null;
    }
}
