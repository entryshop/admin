<?php

namespace Entryshop\Admin\Admin;

use Entryshop\Admin\Support\Renderable;

/**
 * @method string|self url($value = null)
 * @method string|self icon($value = null)
 */
class AdminMenu extends Renderable
{

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
        return $this->builder->set('position', AdminPanel::MENU_POSITION_MAIN);
    }

    public function user()
    {
        return $this->builder->set('position', AdminPanel::MENU_POSITION_USER);
    }
}
