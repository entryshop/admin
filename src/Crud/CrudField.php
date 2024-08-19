<?php

namespace Entryshop\Admin\Crud;

use Closure;
use Entryshop\Admin\Crud\Traits\CanGuessLabel;
use Entryshop\Admin\Crud\Traits\HasLinkage;

/**
 * @method string|self multiple($value = null)
 * @method string|self options($value = null)
 * @method string|self rules($value = null)
 * @method string|self ignore($value = null)
 */
class CrudField extends CrudCell
{
    use CanGuessLabel;
    use HasLinkage;

    protected $view_namespace = 'admin::crud.fields.';
    protected $default_type = 'text';

    public function buildFieldValue(...$args)
    {
        $original_value = $this->getOriginal('value');
        if ($original_value instanceof Closure) {
            return;
        }

        $entity = $args[0]['entity'] ?? $this->crud()->entity();
        if (!empty($entity)) {
            $value = data_get($entity, $this->name());
            $this->set('value', $value);
        }
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
