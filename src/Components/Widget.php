<?php

namespace Entryshop\Admin\Components;

use Entryshop\Utils\Components\HasViewNamespace;
use Entryshop\Utils\Components\Renderable;

class Widget extends Renderable
{
    use HasViewNamespace;

    protected $view_namespace = 'admin::widgets.';
    protected $default_type = 'widget';
}
