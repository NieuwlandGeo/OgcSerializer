<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities;

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
     * @Type("array<Nieuwland\OgcSerializer\Type\WMS\Capabilities\Style>")
     * @XmlList(inline=true, entry="Style", namespace="http://www.opengis.net/wms")
     *
     * @var Style[]
     */
    private $styles;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\ExGeographicBoundingBox")
     * @SerializedName("EX_GeographicBoundingBox")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var ExGeographicBoundingBox
     */
    private $exGeographicBoundingBox;

    /**
     * @Type("array<Nieuwland\OgcSerializer\Type\WMS\Capabilities\BoundingBox>")
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
     * @var array
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
     * @Type("array<Nieuwland\OgcSerializer\Type\WMS\Capabilities\Layer>")
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

    /**
     * Get the value of abstract.
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set the value of abstract.
     *
     * @param string $abstract
     *
     * @return self
     */
    public function setAbstract(string $abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get the value of styles.
     *
     * @return Style[]
     */
    public function getStyles()
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
     *
     * @param string $name
     *
     * @return Style|null
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
     *
     * @return self
     */
    public function setStyles(array $styles)
    {
        $this->styles = $styles;

        return $this;
    }

    /**
     * Get undocumented variable.
     *
     * @return ExGeographicBoundingBox
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
     *
     * @return self
     */
    public function setExGeographicBoundingBox(ExGeographicBoundingBox $exGeographicBoundingBox)
    {
        $this->exGeographicBoundingBox = $exGeographicBoundingBox;

        return $this;
    }

    /**
     * Get the value of boundingBoxes.
     *
     * @return BoundingBox[]
     */
    public function getBoundingBoxes()
    {
        return $this->boundingBoxes;
    }

    /**
     * Get inherited bounding box.
     *
     * @return BoundingBox[]|null
     */
    public function getBoundingBoxOptions(): array
    {
        if ($this->getBoundingBoxes()) {
            return $this->getBoundingBoxes();
        }
        if ($this->getParent()) {
            $this->getParent()->getBoundingBoxOptions();
        }

        return null;
    }

    /**
     * @param string $crs
     *
     * @return BoundingBox|null
     */
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
     *
     * @return self
     */
    public function setBoundingBoxes(array $boundingBoxes)
    {
        $this->boundingBoxes = $boundingBoxes;

        return $this;
    }

    /**
     * Get the value of minScaleDenominator.
     *
     * @return float
     */
    public function getMinScaleDenominator(): ?float
    {
        return $this->minScaleDenominator;
    }

    /**
     * Set the value of minScaleDenominator.
     *
     * @param mixed $minScaleDenominator
     *
     * @return self
     */
    public function setMinScaleDenominator($minScaleDenominator)
    {
        $this->minScaleDenominator = $this->readScaleDenominator($minScaleDenominator);

        return $this;
    }

    /**
     * Get the value of maxScaleDenominator.
     *
     * @return float
     */
    public function getMaxScaleDenominator(): ?float
    {
        return $this->maxScaleDenominator;
    }

    /**
     * Set the value of maxScaleDenominator.
     *
     * @param mixed $maxScaleDenominator
     *
     * @return self
     */
    public function setMaxScaleDenominator($maxScaleDenominator)
    {
        $this->maxScaleDenominator = $this->readScaleDenominator($maxScaleDenominator);

        return $this;
    }

    /**
     * Get flat array of layernames of all children.
     *
     * @return array|null
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
