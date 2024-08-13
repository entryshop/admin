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

        if ($this->builder->has('children')) {
            $children = [];
            foreach ($this->builder->get('children', []) as $child) {
                $children[] = static::make($child);
            }
            $this->builder->set('children', $children);
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
