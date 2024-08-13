<?php

namespace Entryshop\Admin\Admin;

use Entryshop\Admin\Support\HasViewNamespace;
use Entryshop\Admin\Support\Renderable;

/**
 * @method string|self url($value = null)
 * @method string|self icon($value = null)
 */
class AdminPage extends Renderable
{
    use HasViewNamespace;

    protected $view_namespace = 'admin::pages.';
    protected $default_type = 'page';
}
