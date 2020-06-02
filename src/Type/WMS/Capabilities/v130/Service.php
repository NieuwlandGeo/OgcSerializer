<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;
use Nieuwland\OgcSerializer\Exception\UnexpectedValueException;

/**
 * WMS Capabilities Service.
 *
 * @XmlRoot("Service")
 */
class Service
{
    /**
     * @var string
     *
     * @Type("string")
     *
     * @XmlElement(cdata=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     */
    private $title;

    /**
     * @var string
     *
     * @Type("string")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     */
    private $abstract;

    public function getName(): string
    {
        if (null === $this->name) {
            throw UnexpectedValueException::missingProperty('Service', 'name');
        }

        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): string
    {
        if (null === $this->title) {
            throw UnexpectedValueException::missingProperty('Service', 'title');
        }

        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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
}
