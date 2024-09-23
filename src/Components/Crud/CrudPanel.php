<?php

namespace Entryshop\Admin\Components\Crud;

use Entryshop\Admin\Components\Crud\Traits\HasButtons;
use Entryshop\Admin\Components\Crud\Traits\HasColumns;
use Entryshop\Admin\Components\Crud\Traits\HasEntries;
use Entryshop\Admin\Components\Crud\Traits\HasFields;
use Entryshop\Admin\Components\Crud\Traits\HasFilters;
use Entryshop\Admin\Components\Crud\Traits\HasTabs;
use Entryshop\Admin\Components\Traits\AsContainer;
use Entryshop\Utils\Components\Renderable;

class CrudPanel extends Renderable
{
    use AsContainer;
    use HasButtons;
    use HasColumns;
    use HasEntries;
    use HasFields;
    use HasFilters;
    use HasTabs;

    public function __construct(...$args)
    {
        parent::__construct(...$args);

        if (isset($args[0]) && is_string($args[0])) {
            $name = $args[0];
        }

        $this->set('name', $name ?? 'crud_' . uniqid());
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

    public function url($path = '', $params = [])
    {
        $path = '/' . ltrim($path, '/');
        return admin()->url($this->route() . $path, $params);
    }

    public function path($path = '', $params = [])
    {
        $path = '/' . ltrim($path, '/');
        return admin()->path($this->route() . $path, $params);
    }
}
