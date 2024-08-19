<?php

namespace Entryshop\Admin\Components;

use Entryshop\Admin\Support\HasViewNamespace;
use Entryshop\Admin\Support\Renderable;

class Widget extends Renderable
{
    use HasViewNamespace;

    protected $view_namespace = 'admin::widgets.';
    protected $default_type = 'widget';
}
