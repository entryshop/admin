<?php


namespace Entryshop\Admin\Crud\Traits;

use Illuminate\Database\Query\Builder;

/**
 * @method string|self model($value = null)
 * @method string|self route($value = null)
 * @method string|self label($value = null)
 * @method string|self labelPlural($value = null)
 * @method string|self lang($value = null) set language prefix
 */
trait HasEntries
{
    protected $_entries;
    protected $_entry;

    /**
     * @return Builder
     */
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
        return $this->builder->get('labelPlural', $this->builder->get('label'));
    }
}
