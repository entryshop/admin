<?php

namespace Entryshop\Admin\Admin;

use Entryshop\Admin\Admin\Traits\HasActionResponse;
use Entryshop\Admin\Admin\Traits\HasAssets;
use Entryshop\Admin\Admin\Traits\HasBrand;
use Entryshop\Admin\Admin\Traits\HasMenus;
use Entryshop\Admin\Admin\Traits\HasRoutes;
use Entryshop\Admin\Admin\Traits\HasToasts;
use Entryshop\Admin\Support\HasContext;
use Entryshop\Admin\Support\Renderable;

/**
 * @method string|self back($value = null) back url
 */
class AdminPanel extends Renderable
{
    use HasActionResponse;
    use HasAssets;
    use HasBrand;
    use HasMenus;
    use HasRoutes;
    use HasToasts;

    protected $default_view = 'admin::layouts.app';

    public function guest()
    {
        $this->set('view', 'admin::layouts.guest');
        return $this;
    }
}
