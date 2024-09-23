<?php

namespace Entryshop\Admin\Admin;

use Entryshop\Utils\Components\Renderable;

/**
 * @method string|static url($value = null)
 * @method string|static icon($value = null)
 * @method string|static order($value = null)
 */
class AdminMenu extends Renderable
{
    protected $default_child = AdminMenu::class;

    public function __construct(...$args)
    {
        parent::__construct(...$args);

        if (!empty($args[0]['children'])) {
            $children = $args[0]['children'];
            foreach ($children as $child) {
                $this->child($child);
            }
        }
    }

    public function main()
    {
        return $this->set('position', AdminPanel::MENU_POSITION_MAIN);
    }

    public function user()
    {
        return $this->set('position', AdminPanel::MENU_POSITION_USER);
    }
}
