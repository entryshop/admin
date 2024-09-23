<?php

namespace Entryshop\Admin\Admin;

use Entryshop\Utils\Components\Menu;

/**
 * @method string|static url($value = null)
 * @method string|static icon($value = null)
 * @method string|static order($value = null)
 */
class AdminMenu extends Menu
{
    public function main()
    {
        return $this->set('position', AdminPanel::MENU_POSITION_MAIN);
    }

    public function user()
    {
        return $this->set('position', AdminPanel::MENU_POSITION_USER);
    }
}
