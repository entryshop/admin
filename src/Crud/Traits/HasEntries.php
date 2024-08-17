<?php


namespace Entryshop\Admin\Crud\Traits;

use Illuminate\Support\Str;

/**
 * @method string|self model($value = null)
 * @method string|self route($value = null)
 * @method string|self label($value = null)
 * @method string|self labelPlural($value = null)
 * @method string|self lang($value = null) Set language prefix
 */
trait HasEntries
{
    protected $_entries;
    protected $_entry;

    public function entries($value = null)
    {
        if (!empty($value)) {
            $this->_entries = $value;
            return $this;
        }

        if (empty($this->_entries)) {
            $this->_entries = app($this->model())->query();
        }

        return $this->_entries;
    }

    public function findOrFail($id)
    {
        $this->_entry = $this->entries()->findOrFail($id);
        return $this->_entry;
    }

    public function entry($value = null)
    {
        if (!empty($value)) {
            $this->_entry = $value;
            return $this;
        }

        return $this->_entry;
    }

    public function title()
    {
        return $this->get('labelPlural', $this->get('label'));
    }

    public function labels($label, $labelPlural = null)
    {
        return $this->set('label', $label)->set('labelPlural', $labelPlural ?? $label);
    }

    public function trans($key)
    {
        $lang_key = $this->get('lang') . '.' . $key;
        if (trans()->has($lang_key)) {
            return trans($lang_key);
        }

        // load common lang
        if (trans()->has('admin::crud.attributes.' . $key)) {
            return trans('admin::crud.attributes.' . $key);
        }

        return Str::headline($key);
    }
}
