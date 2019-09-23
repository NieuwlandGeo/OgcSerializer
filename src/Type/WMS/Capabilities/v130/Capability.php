<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;

/**
 * WMS Capabilities Capability.
 *
 * @XmlNamespace("http://www.opengis.net/wms")
 */
class Capability
{
    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Layer")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var Layer
     */
    private $layer;

    /**
     * @Type("Nieuwland\OgcSerializer\Type\WMS\Capabilities\v130\Request")
     * @XmlElement(namespace="http://www.opengis.net/wms")
     *
     * @var Request
     */
    private $request;

    /**
     * Get the value of layers.
     *
     */
    public function getLayer(): Layer
    {
        return $this->layer;
    }

    /**
     * Set the value of layers.
     *
     *
     */
    public function setLayer(Layer $layer): self
    {
        $this->layer = $layer;

        return $this;
    }

    /**
     * Get the value of request.
     *
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Set the value of request.
     *
     *
     */
    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }
}
