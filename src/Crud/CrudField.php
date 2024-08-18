<?php

namespace Entryshop\Admin\Crud;

use Entryshop\Admin\Crud\Traits\CanGuessLabel;

/**
 * @method string|self multiple($value = null)
 * @method string|self options($value = null)
 * @method string|self rules($value = null)
 */
class CrudField extends CrudCell
{
    use CanGuessLabel;

    protected $view_namespace = 'admin::crud.fields.';
    protected $default_type = 'text';

    public function value($value = null)
    {
        if (empty($value)) {
            return $this->get('value', data_get($this->crud()->entry(), $this->name()));
        }

        return $this->set('value', $value);
    }

    public function getValueFromRequest($model = null)
    {
        $name = $this->name();
        switch ($this->get('type')) {
            case 'file':
                if (request()->hasFile($name)) {
                    $value = \Storage::url(request()->file($name)->store('uploads'));
                } else {
                    $value = data_get($model, $name);
                }
                break;
            case 'switch':
                $value = request($name) ? 1 : 0;
                break;
            default:
                $value = request($name);
                break;
        }
        return $value;
    }
}
