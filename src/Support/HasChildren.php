<?php

namespace Entryshop\Admin\Support;

trait HasChildren
{
    protected $_children = [];

    public function children($position = null)
    {
        if (is_array($position)) {
            foreach ($position as $item) {
                $this->child($item);
            }
            return $this;
        }

        if (empty($position)) {
            return array_filter($this->_children, function ($child) use ($position) {
                return empty($child->get('position'));
            });
        }

        return array_filter($this->_children, function ($child) use ($position) {
            return $child->get('position') === $position;
        });
    }

    public function child(...$args)
    {
        if (empty($args[0])) {
            abort(400, 'Unknown child type');
        }

        if ($args[0] instanceof Renderable) {
            $child = $args[0];
        } elseif (is_array($args[0])) {
            $child = Renderable::make($args[0]);
        } elseif (is_string($args[0])) {
            $child = Renderable::make(['name' => $args[0]]);
        } else {
            $child = Renderable::make(...$args);
        }

        $key = $child->name() ?? $child->key();

        if (!empty($this->_children[$key])) {
            return $this->_children[$key];
        }

        $this->_children[$key] = $child;
        return $child;
    }
}
