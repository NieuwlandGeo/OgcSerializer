<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Utils;

use DOMNode;
use Symfony\Component\DomCrawler\Crawler;

use function assert;
use function explode;
use function is_numeric;
use function is_string;
use function sprintf;
use function strpos;
use function strstr;
use function substr;

class WfsSchemaReader
{
    /**
     * extract fields from xsd.
     *
     * @param string $name featuretype name including prefix
     *
     * @throws WfsSchemaException
     *
     */
    public function extractFields(string $xsd, string $name): WfsSchema
    {
        $schema     = new WfsSchema();
        $crawler    = new Crawler($xsd);
        $schemaNode = $crawler->getNode(0);
        if (! $schemaNode) {
            throw new WfsSchemaException('Schema node at position 0 not found');
        }

        $xsdPrefix      = $schemaNode->lookupPrefix('http://www.w3.org/2001/XMLSchema');
        $nameAttr       = $this->getNameAttribute($schemaNode, $name);
        $xpath          = sprintf("//%s:element[@name='%s']", $xsdPrefix, $nameAttr);
        $elementCrawler = $crawler->filterXPath($xpath);
        $elementNode    = $elementCrawler->getNode(0);

        if (! $elementNode) {
            throw new WfsSchemaException(sprintf('Element node with name %s not found', $nameAttr));
        }

        $complexTypeName = $elementNode->attributes->getNamedItem('type')->nodeValue;
        $complexNameAttr = $this->getNameAttribute($schemaNode, $complexTypeName);

        $complexElementPath = sprintf(
            "//%s:complexType[@name='%s']//%s:element",
            $xsdPrefix,
            $complexNameAttr,
            $xsdPrefix
        );

        $complexElementCrawler = $crawler->filterXPath($complexElementPath);
        $targetNamespace       = $this->getTargetNameSpace($schemaNode);
        $schema->setNamespaceUri($targetNamespace);
        foreach ($complexElementCrawler as $element) {
            assert($element instanceof DOMNode);
            $fullType = $this->getAttributeValue($element, 'type');
            // if type has prefix
            if (! is_string($fullType)) {
                $typeName         = '';
                $typeNamespaceUri = '';
            } elseif (false !== strpos($fullType, ':')) {
                [$prefix, $typeName] = explode(':', $fullType);
                $typeNamespaceUri    = $schemaNode->lookupNamespaceUri($prefix);
            } else {
                $typeName         = $fullType;
                $typeNamespaceUri = $targetNamespace;
            }

            $element = new WfsSchemaElement(
                $this->getAttributeValue($element, 'name'),
                $typeName,
                $typeNamespaceUri,
                $this->getAttributeValue($element, 'nillable'),
                $this->getAttributeValue($element, 'minOccurs'),
                $this->getAttributeValue($element, 'maxOccurs')
            );
            $schema->addElement($element);
        }

        return $schema;
    }

    /**
     * @return mixed
     */
    private function getAttributeValue(DOMNode $node, string $name)
    {
        $attr = $node->attributes->getNamedItem($name);
        if (! $attr) {
            return null;
        }

        if ('true' === $attr->nodeValue) {
            return true;
        }

        if ('false' === $attr->nodeValue) {
            return false;
        }

        if (is_numeric($attr->nodeValue)) {
            return (int) $attr->nodeValue;
        }

        return $attr->nodeValue;
    }

    /**
     * Target namespace.
     */
    private function getTargetNameSpace(DOMNode $schemaNode): string
    {
        return $schemaNode->attributes->getNamedItem('targetNamespace')->nodeValue;
    }

    /**
     * Get name attribute to use for node filtering.
     *
     * @param string $name prefixed
     *
     * @return string without prefix if it equals targetNameSpace
     */
    private function getNameAttribute(DOMNode $schemaNode, string $name): string
    {
        $namePrefix       = strstr($name, ':', true);
        $elementNameSpace = $schemaNode->lookupNamespaceUri('ogr') ?? $schemaNode->lookupNamespaceUri($namePrefix);
        $targetNameSpace  = $this->getTargetNameSpace($schemaNode);

        return $targetNameSpace === $elementNameSpace
            ? substr(strstr($name, ':'), 1)
            : $name;
    }
}
