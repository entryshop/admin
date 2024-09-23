<?php

namespace Entryshop\Admin\Components\Crud;

use Entryshop\Utils\Components\HasViewNamespace;
use Entryshop\Utils\Components\Renderable;
use Illuminate\Support\Str;

/**
 * @method string|static name($value = null)
 * @method string|static label($value = null)
 * @method string|static key($value = null)
 * @method string|static type($value = null)
 */
class CrudCell extends Renderable
{
    use HasViewNamespace;

    protected CrudPanel $_crud;

    public function __construct(...$args)
    {
        if (isset($args[0]) && is_string($args[0])) {
            $data = [
                'name'  => $args[0],
                'label' => $args[1] ?? null,
                'key'   => $args[2] ?? $args[0],
            ];
            parent::__construct($data);
            return;
        }

        parent::__construct(...$args);

        if (empty($this->name())) {
            $this->set('name', Str::lower(class_basename(static::class)) . '_' . uniqid());
        }
    }

    public function select($options)
    {
        return $this->type('select')->set('options', $options);
    }

    public function radio($options)
    {
        return $this->type('radio')->set('options', $options);
    }

    public function crud($value = null)
    {
        if (empty($value)) {
            return $this->_crud;
        }
        $this->_crud = $value;
        return $this;
    }

    public function full()
    {
        return $this->class('w-100 col-12');
    }

}
