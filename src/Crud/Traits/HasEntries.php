<?php


namespace Entryshop\Admin\Crud\Traits;

use Illuminate\Support\Str;

/**
 * @method string|static model($value = null)
 * @method string|static route($value = null)
 * @method string|static lang($value = null) Set language prefix
 */
trait HasEntries
{
    protected $_entities;
    protected $_entity;

    public function entities($value = null)
    {
        if (!empty($value)) {
            $this->_entities = $value;
            return $this;
        }

        if (empty($this->_entities)) {
            $this->_entities = app($this->model())->query();
        }

        return $this->_entities;
    }

    public function findOrFail($id)
    {
        $this->_entity = $this->entities()->findOrFail($id);
        return $this->_entity;
    }

    public function entity($value = null)
    {
        if (!empty($value)) {
            $this->_entity = $value;
            return $this;
        }

        return $this->_entity;
    }

    public function labelPlural($value = null)
    {
        if (!empty($value)) {
            return $this->set('labelPlural', $value);
        }
        return $this->get('labelPlural', $this->guessLabelFromModel(true));
    }

    protected function guessLabelFromModel($plural = false)
    {
        $label = class_basename($this->get('model') ?? 'Model');
        if ($plural) {
            return Str::plural($label);
        }
        return $label;
    }

    public function label($value = null)
    {
        if (!empty($value)) {
            return $this->set('label', $value);
        }

        return $this->get('label', $this->guessLabelFromModel());
    }

    public function labels($label, $labelPlural = null)
    {
        return $this->set('label', $label)->set('labelPlural', $labelPlural);
    }

    public function trans($key)
    {
        $lang_key = $this->get('lang') . '.' . $key;
        if (trans()->has($lang_key)) {
            return trans($lang_key);
        }

        if (trans()->has('admin::crud.attributes.' . $key)) {
            return trans('admin::crud.attributes.' . $key);
        }

        return Str::headline($key);
    }
}
