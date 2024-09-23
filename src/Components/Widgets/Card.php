<?php

namespace Entryshop\Admin\Components\Widgets;

use Entryshop\Admin\Components\Widget;

/**
 * @method self title($value) Set card title
 * @method self content($value) Set content
 * @method self right($value) Set right
 * @method self footer($value) Set footer
 */
class Card extends Widget
{
    protected $default_type = 'card';
}
