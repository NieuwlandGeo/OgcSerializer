<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities;

use function array_combine;
use function array_map;

/**
 * AbstractFeatureTypeList WFS Capabilities.
 */
abstract class AbstractFeatureTypeList
{
    /** @var AbstractFeatureType[] */
    protected $featureTypes = [];

    /**
     * Get the value of featureTypes.
     *
     * @return AbstractFeatureType[]
     */
    abstract public function getFeatureTypes(): array;

    /**
     * Key featureTypes by name .
     *
     * @param AbstractFeatureType[] $featureTypes
     */
    public function setFeatureTypes(array $featureTypes): self
    {
        $keys = array_map(static function (AbstractFeatureType $type) {
            return $type->getName();
        }, $featureTypes);

        $this->featureTypes = array_combine($keys, $featureTypes);

        return $this;
    }
}
