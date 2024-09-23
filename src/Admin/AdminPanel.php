<?php

namespace Entryshop\Admin\Admin;

use Entryshop\Admin\Admin\Traits\HasActionResponse;
use Entryshop\Admin\Admin\Traits\HasAssets;
use Entryshop\Admin\Admin\Traits\HasBrand;
use Entryshop\Admin\Admin\Traits\HasRoutes;
use Entryshop\Admin\Admin\Traits\HasToasts;
use Entryshop\Utils\Components\HasMenus;
use Entryshop\Utils\Components\Renderable;

/**
 * @method string|static back($value = null) back url
 */
class AdminPanel extends Renderable
{
    use HasActionResponse;
    use HasAssets;
    use HasBrand;
    use HasMenus;
    use HasRoutes;
    use HasToasts;

    protected $menu_class = AdminMenu::class;

    const MENU_POSITION_MAIN = 'main';
    const MENU_POSITION_USER = 'user';

    protected $default_view = 'admin::layouts.app';

    public function guest()
    {
        $this->set('view', 'admin::layouts.guest');
        return $this;
    }
}
