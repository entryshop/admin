<?php

namespace Entryshop\Admin\Support;

use Illuminate\Support\Str;

/**
 * @mixin Builder
 * @method string|self escape($value = null) Display as html
 */
class Renderable
{
    use BootTraits;
    use Makable;
    use HasChildren;
    use HasAttributes;

    protected $default_view;

    protected Builder $builder;

    public function __construct(...$args)
    {
        $this->register(...$args);
        $this->builder = new Builder($this, ...$args);

        if (empty($this->key())) {
            $this->key(Str::lower(class_basename(static::class)) . '_' . uniqid());
        }
    }

    public function __call($method, $arguments)
    {
        return $this->builder->$method(...$arguments);
    }

    public function render(...$args)
    {
        if ($this->builder->get('hide')) {
            return '';
        }

        if ($this->builder->has('display')) {
            $this->boot();
            return $this->builder->get('display');
        }
        return view($this->getView(...$args), $this->getViewData(...$args));
    }

    public function getView(...$args)
    {
        if ($this->builder->get('hide')) {
            return 'admin::hidden';
        }

        return $this->view() ?? $this->default_view;
    }

    public function getViewData(...$args)
    {
        $data = [
            'builder'    => $this->builder,
            'renderable' => $this,
        ];
        $this->boot();
        if (!empty($args[0]) && is_array($args[0])) {
            $data = array_merge($data, $args[0]);
        }
        return array_merge($data, $this->variables());
    }

    public function hide(...$args)
    {
        if (count($args) === 0) {
            return $this->builder->get('hide', false);
        }
        return $this->set('hide', $args[0]);
    }
}
