<?php

namespace Entryshop\Admin\Support;

trait HasChildren
{
    public function children($value = null)
    {
        if (empty($value)) {
            return $this->builder->get('children') ?? [];
        }

        if (is_array($value)) {
            foreach ($value as $child) {
                $this->child($child);
            }
        }

        return $this;
    }

    public function child($value)
    {
        if (is_array($value)) {
            $value = static::make($value);
        }
        $children   = $this->builder->get('children') ?? [];
        $children[] = $value;

        $this->builder->set('children', $children);

        return $this;
    }
}
