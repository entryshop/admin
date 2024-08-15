<?php

namespace Entryshop\Admin\Crud;

use Entryshop\Admin\Support\HasViewNamespace;
use Entryshop\Admin\Support\Renderable;
use Illuminate\Support\Str;

/**
 * @method string|self name($value = null)
 * @method string|self label($value = null)
 * @method string|self key($value = null)
 * @method string|self type($value = null)
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

    public function crud($value = null)
    {
        if (empty($value)) {
            return $this->_crud;
        }
        $this->_crud = $value;
        return $this;
    }
}
