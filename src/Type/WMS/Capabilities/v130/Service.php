<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Assert\NotNull
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
