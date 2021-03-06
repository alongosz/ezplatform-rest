<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformRest\Server\Values;

use eZ\Publish\API\Repository\Values\ValueObject;

/**
 * Struct representing a published Role.
 */
class PublishedRole extends ValueObject
{
    /**
     * The published role.
     *
     * @var \EzSystems\EzPlatformRest\Server\Values\RestRole
     */
    public $role;
}
