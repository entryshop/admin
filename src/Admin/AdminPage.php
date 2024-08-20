<?php

namespace Entryshop\Admin\Admin;

use Entryshop\Admin\Support\HasViewNamespace;
use Entryshop\Admin\Support\Renderable;

/**
 * @method string|static url($value = null)
 * @method string|static icon($value = null)
 */
class AdminPage extends Renderable
{
    use HasViewNamespace;

    protected $view_namespace = 'admin::pages.';
    protected $default_type = 'page';
}
