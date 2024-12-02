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

    const POSITION_BEFORE_CONTENT = 'before_content';
    const POSITION_AFTER_CONTENT  = 'after_content';
    const POSITION_BEFORE_HEADER  = 'before_header';
    const POSITION_AFTER_HEADER   = 'after_header';
    const POSITION_BEFORE_FOOTER  = 'before_footer';
    const POSITION_AFTER_FOOTER   = 'after_footer';
    const POSITION_BEFORE_BODY    = 'before_body';
    const POSITION_AFTER_BODY     = 'after_body';

    public $is_form = false;
    public $is_table = false;
    public $is_show = false;

    public function __construct(...$args)
    {
        parent::__construct(...$args);

        if (isset($args[0]) && is_string($args[0])) {
            $name = $args[0];
        }

        $this->set('name', $name ?? 'crud_' . uniqid());
    }

    public function __call($method, $parameters)
    {
        if (($this->is_table || $this->is_show) && !empty($this->columns_map[$method])) {
            $column = call_user_func_array([$this->columns_map[$method], 'make'], $parameters);
            return $this->column($column);
        }

        if ($this->is_form && !empty($this->fields_map[$method])) {
            $field = call_user_func_array([$this->fields_map[$method], 'make'], $parameters);
            return $this->field($field);
        }

        return parent::__call($method, $parameters);
    }

    public function form()
    {
        $this->is_form = true;
        return $this->set('view', 'admin::crud.form');
    }

    public function table()
    {
        $this->is_table = true;
        return $this->set('view', 'admin::crud.table');
    }

    public function show()
    {
        $this->is_show = true;
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
