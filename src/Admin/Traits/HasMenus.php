<?php

namespace Entryshop\Admin\Admin\Traits;

use Entryshop\Admin\Admin\AdminMenu;

/**
 */
trait HasMenus
{
    const MENU_POSITION_MAIN     = 'main';
    const MENU_POSITION_USER     = 'user';
    const HOOK_ACTION_ADMIN_MENU = 'hook_action_admin_menu';

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
            if (!empty($args[0][0]) && is_array($args[0][0])) {
                foreach ($args[0] as $menu) {
                    $this->menu($menu);
                }
                return $this;
            }
            $menu = AdminMenu::make($args[0]);

            $this->_menus[$menu->name() ?? $menu->key()] = $menu;

            return $menu;
        }

        return $this;
    }

    public function bootHasMenus()
    {
        hook_action(self::HOOK_ACTION_ADMIN_MENU);
    }

    public function menus($position = null)
    {
        if (empty($position)) {
            $menus = $this->_menus;
        } else {
            $menus = array_filter($this->_menus, function ($menu) use ($position) {
                return $menu->get('position') === $position;
            });
        }

        usort($menus, function ($a, $b) {
            return $a->get('order') <=> $b->get('order');
        });

        return $menus;
    }
}
