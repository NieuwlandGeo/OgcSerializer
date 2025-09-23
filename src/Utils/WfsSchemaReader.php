<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Utils;

use DOMNode;
use Symfony\Component\DomCrawler\Crawler;

use function assert;
use function explode;
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
        if (null === $schemaNode) {
            throw new WfsSchemaException('Schema node at position 0 not found');
        }

        $nameAttr       = $this->getNameAttribute($schemaNode, $name);
        $xsdPrefix      = $schemaNode->lookupPrefix('http://www.w3.org/2001/XMLSchema') ?? 'default';
        $xsdPrefixColon = null === $nameAttr ? '' : sprintf('%s:', $xsdPrefix);

        $xpath          = sprintf("//%selement[@name='%s']", $xsdPrefixColon, $nameAttr ?? $name);
        $elementCrawler = $crawler->filterXPath($xpath);
        $elementNode    = $elementCrawler->getNode(0);

        if (null === $elementNode) {
            throw new WfsSchemaException(sprintf('Element node with name %s not found', $nameAttr ?? $name));
        }

        $complexTypeName = $elementNode->attributes->getNamedItem('type')->nodeValue;
        $complexNameAttr = $this->getNameAttribute($schemaNode, $complexTypeName);

        $complexElementPath = sprintf(
            "//%scomplexType[@name='%s']//%selement",
            $xsdPrefixColon,
            $complexNameAttr,
            $xsdPrefixColon
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
                $typePrefix       = '';
            } elseif (false !== strpos($fullType, ':')) {
                [$typePrefix, $typeName] = explode(':', $fullType);
                $typeNamespaceUri        = $schemaNode->lookupNamespaceUri($typePrefix) ?? '';
            } else {
                $typeName         = $fullType;
                $typeNamespaceUri = $targetNamespace;
                $typePrefix       = '';
            }

            $element = new WfsSchemaElement(
                $this->getAttributeValue($element, 'name'),
                $typeName,
                $typeNamespaceUri,
                $typePrefix,
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
        if (null === $attr) {
            return null;
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
    private function getNameAttribute(DOMNode $schemaNode, string $name): ?string
    {
        $namePrefix = strstr($name, ':', true);
        if (false === $namePrefix) {
            return null;
        }

        $elementNameSpace = $schemaNode->lookupNamespaceUri('ogr') ?? $schemaNode->lookupNamespaceUri($namePrefix);
        $targetNameSpace  = $this->getTargetNameSpace($schemaNode);

        return $targetNameSpace === $elementNameSpace || null === $elementNameSpace
            ? substr(strstr($name, ':'), 1)
            : $name;
    }
}
