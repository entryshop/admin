<?php

namespace Entryshop\Admin\Components\Crud\Columns;

use Entryshop\Admin\Components\Crud\CrudColumn;

class TextColumn extends CrudColumn
{
    protected $view_namespace = 'admin::crud.columns.';
    protected $default_type = 'text';

    public function currency($in = '', $locale = null)
    {
        $this->set('is_currency', true);
        $this->set('currency_in', $in);
        $this->set('currency_locale', $locale);
        return $this;
    }

    public function href($link, $target = '_self')
    {
        $this->set('href', $link);
        $this->set('target', $target);
        return $this;
    }

    public function copyable($value = true)
    {
        return $this->set('copyable', $value);
    }
}
