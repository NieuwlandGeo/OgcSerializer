<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Utils;

use DOMNode;
use Exception;
use Symfony\Component\DomCrawler\Crawler;
use function sprintf;
use function strstr;
use function substr;

class WfsSchemaReader
{
    /**
     * extract fields from xsd.
     *
     * @param string $xsd
     * @param string $name featuretype name including prefix
     */
    public function extractFields(string $xsd, string $name): array
    {
        $fields     = [];
        $crawler    = new Crawler($xsd);
        $schemaNode = $crawler->getNode(0);
        if (! $schemaNode) {
            throw new Exception('Schema node at position 0 not found');
        }
        $xsdPrefix      = $schemaNode->lookupPrefix('http://www.w3.org/2001/XMLSchema');
        $nameAttr       = $this->getNameAttribute($schemaNode, $name);
        $xpath          = sprintf("//%s:element[@name='%s']", $xsdPrefix, $nameAttr);
        $elementCrawler = $crawler->filterXPath($xpath);
        $elementNode    = $elementCrawler->getNode(0);
        if (! $schemaNode) {
            throw new Exception(sprintf('Element node with name %s not found', $nameAttr));
        }
        $complexTypeName       = $elementNode->attributes->getNamedItem('type')->nodeValue;
        $complexNameAttr       = $this->getNameAttribute($schemaNode, $complexTypeName);
        $complexElementPath    = sprintf(
            "//%s:complexType[@name='%s']//%s:element",
            $xsdPrefix,
            $complexNameAttr,
            $xsdPrefix
        );
        $complexElementCrawler =  $crawler->filterXPath($complexElementPath);

        foreach ($complexElementCrawler as $element) {
        }

        return $fields;
    }

    /**
     * Target namespace.
     *
     * @param DOMNode $schemaNode
     *
     * @return string
     */
    private function getTargetNameSpace(DOMNode $schemaNode): string
    {
        return $schemaNode->attributes->getNamedItem('targetNamespace')->nodeValue;
    }

    /**
     * Get name attribute to use for node filtering.
     *
     * @param DOMNode $schemaNode
     * @param string  $name       prefixed
     *
     * @return string without prefix if it equals targetNameSpace
     */
    private function getNameAttribute(DOMNode $schemaNode, string $name): string
    {
        $namePrefix       = strstr($name, ':', true);
        $elementNameSpace = $schemaNode->lookupNamespaceUri($namePrefix);
        $targetNameSpace  = $this->getTargetNameSpace($schemaNode);

        return $targetNameSpace === $elementNameSpace
            ? substr(strstr($name, ':'), 1)
            : $name;
    }
}
