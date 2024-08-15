<?php

namespace Entryshop\Admin\Crud;

use Entryshop\Admin\Crud\Traits\HasButtons;
use Entryshop\Admin\Crud\Traits\HasColumns;
use Entryshop\Admin\Crud\Traits\HasEntries;
use Entryshop\Admin\Crud\Traits\HasFields;
use Entryshop\Admin\Crud\Traits\HasFilters;
use Entryshop\Admin\Support\Renderable;

class CrudPanel extends Renderable
{
    use HasButtons;
    use HasColumns;
    use HasEntries;
    use HasFields;
    use HasFilters;

    public function __construct(...$args)
    {
        parent::__construct(...$args);

        if (isset($args[0]) && is_string($args[0])) {
            $name = $args[0];
        }

        $this->builder->set('name', $name ?? 'crud_' . uniqid());
    }

    public function form()
    {
        return $this->set('view', 'admin::crud.form');
    }

    public function table()
    {
        return $this->set('view', 'admin::crud.table');
    }

    public function show()
    {
        return $this->set('view', 'admin::crud.show');
    }

    public function url($path = '')
    {
        $path = ltrim($path, '/');
        return admin()->url($this->route() . '/' . $path);
    }

    public function labels($label, $labelPlural = null)
    {
        return $this->set('label', $label)->set('labelPlural', $labelPlural ?? $label);
    }
}
