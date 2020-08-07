<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;

class DomainType
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
     * @var string
     *
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     */
    protected $noValues;
    /**
     * @var string
     *
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     */
    protected $defaultValue;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WFS\Capabilities\v200\AllowedValues")
     * @XmlElement(namespace="http://www.opengis.net/ows/1.1")
     *
     * @var AllowedValues
     */
    protected $allowedValues;

    public function getAllowedValues(): AllowedValues
    {
        return $this->allowedValues;
    }

    /**
     * @param AllowedValues[] $allowedValues
     */
    public function setAllowedValues(array $allowedValues): self
    {
        $this->allowedValues = $allowedValues;

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

    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    public function setDefaultValue(?string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getNoValues(): ?string
    {
        return $this->noValues;
    }

    public function setNoValues(): self
    {
        $this->noValues = '';

        return $this;
    }
}
