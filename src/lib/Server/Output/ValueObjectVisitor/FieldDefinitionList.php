<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformRest\Server\Output\ValueObjectVisitor;

use EzSystems\EzPlatformRest\Output\Generator;
use EzSystems\EzPlatformRest\Output\Visitor;
use EzSystems\EzPlatformRest\Server\Values\RestFieldDefinition as ValuesRestFieldDefinition;

/**
 * FieldDefinitionList value object visitor.
 */
class FieldDefinitionList extends RestContentTypeBase
{
    /**
     * Visit struct returned by controllers.
     *
     * @param \EzSystems\EzPlatformRest\Output\Visitor $visitor
     * @param \EzSystems\EzPlatformRest\Output\Generator $generator
     * @param \EzSystems\EzPlatformRest\Server\Values\FieldDefinitionList $data
     */
    public function visit(Visitor $visitor, Generator $generator, $data)
    {
        $fieldDefinitionList = $data;
        $contentType = $fieldDefinitionList->contentType;

        $urlTypeSuffix = $this->getUrlTypeSuffix($contentType->status);

        $generator->startObjectElement('FieldDefinitions', 'FieldDefinitionList');
        $visitor->setHeader('Content-Type', $generator->getMediaType('FieldDefinitionList'));
        //@todo Needs refactoring, disabling certain headers should not be done this way
        $visitor->setHeader('Accept-Patch', false);

        $generator->startAttribute(
            'href',
            $this->router->generate(
                'ezpublish_rest_loadContentType' . $urlTypeSuffix . 'FieldDefinitionList',
                [
                    'contentTypeId' => $contentType->id,
                ]
            )
        );
        $generator->endAttribute('href');

        $generator->startList('FieldDefinition');
        foreach ($fieldDefinitionList->fieldDefinitions as $fieldDefinition) {
            $visitor->visitValueObject(
                new ValuesRestFieldDefinition($contentType, $fieldDefinition)
            );
        }
        $generator->endList('FieldDefinition');

        $generator->endObjectElement('FieldDefinitions');
    }
}
