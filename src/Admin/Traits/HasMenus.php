<?php

namespace Entryshop\Admin\Admin\Traits;

use Entryshop\Admin\Admin\AdminMenu;
use Illuminate\Support\Str;

/**
 */
trait HasMenus
{
    const MENU_POSITION_MAIN = 'main';
    const MENU_POSITION_USER = 'user';

    protected $_menus = [];

    public function menu(...$args)
    {
        if (is_string($args[0] ?? null)) {

            if (!empty($this->_menus[$args[0]])) {
                return $this->_menus[$args[0]];
            }

            $menu = [
                'name'     => $args[0],
                'label'    => $args[1] ?? $args[0],
                'url'      => $args[2] ?? '#',
                'position' => $args[3] ?? null,
            ];
            return $this->menu($menu);
        }

        if (is_array($args[0])) {
            // multiple menu
            if (!empty($args[0][0]) && is_array($args[0][0])) {
                foreach ($args[0] as $menu) {
                    $this->menu($menu);
                }
                return $this;
            }

            $menu = AdminMenu::make($args[0]);

            $this->_menus[$menu->get('name', 'menu_' . Str::random())] = $menu;

            return $menu;
        }

        return $this;
    }

    public function menus($position = null)
    {
        if (empty($position)) {
            return $this->_menus;
        }

        return array_filter($this->_menus, function ($menu) use ($position) {
            return $menu->get('position') === $position;
        });
    }
}
