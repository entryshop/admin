<?php

namespace Entryshop\Admin\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Delete extends Route
{
    public string $method = 'delete';
}
