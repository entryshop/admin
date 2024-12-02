<?php

namespace Entryshop\Admin\Components\Crud\Traits;

use Entryshop\Admin\Components\Crud\CrudField;
use Entryshop\Admin\Components\Crud\Fields\CheckboxField;
use Entryshop\Admin\Components\Crud\Fields\DateField;
use Entryshop\Admin\Components\Crud\Fields\RadioField;
use Entryshop\Admin\Components\Crud\Fields\SelectField;
use Entryshop\Admin\Components\Crud\Fields\SwitchField;
use Entryshop\Admin\Components\Crud\Fields\TextField;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * @method string|static action($value = null)
 * @method string|static method($value = null)
 * @method string|static messages($value = null)
 * @method string|static fields_only($value = null)
 * @method TextField text(...$args)
 * @method SelectField select(...$args)
 * @method SwitchField switch (...$args)
 * @method CheckboxField checkbox (...$args)
 * @method RadioField radio (...$args)
 */
trait HasFields
{

    protected $fields_map = [
        'text'     => TextField::class,
        'select'   => SelectField::class,
        'date'     => DateField::class,
        'switch'   => SwitchField::class,
        'checkbox' => CheckboxField::class,
        'radio'    => RadioField::class,
    ];

    /**
     * @param ...$args
     * @return CrudField
     */
    public function field(...$args)
    {
        if (!empty($args[0]) && $args[0] instanceof CrudField) {
            $cell = $args[0];
        } else {
            $cell = CrudField::make(...$args);
        }

        $cell->crud($this);
        $this->child($cell);
        return $cell;
    }

    public function fields(...$args)
    {
        if (!count($args)) {
            return $this->getFieldsFromRenderable($this);
        }

        $value = $args[0];
        if (is_array($value)) {
            foreach ($value as $cell) {
                $this->field($cell);
            }
        }
        return $this;
    }

    protected function getFieldsFromRenderable($renderable)
    {
        $fields = [];
        foreach ($renderable->children() as $child) {
            if ($child instanceof CrudField) {
                $fields[$child->key()] = $child;
                continue;
            }
            if ($child->children()) {
                $sub_fields = $this->getFieldsFromRenderable($child);
                $fields     = array_merge($fields, $sub_fields);
            }
        }
        return $fields;
    }

    public function save()
    {
        $model = $this->entity() ?? app($this->get('model'));
        $this->saving($model);
        $model->save();
        $this->entity($model);
        return $this;
    }

    public function saving($model)
    {
        foreach ($this->fields() as $field) {
            if ($field->ignore()) {
                continue;
            }
            $name  = $field->name();
            $value = $field->getValueFromRequest($model);
            if ($model->isRelation($name)) {
                $relation     = $model->$name();
                $relationType = class_basename($relation);
                switch ($relationType) {
                    case 'BelongsToMany':
                    case 'HasMany':
                        $model->{$name}()->sync($value);
                        break;
                    default:
                        $model->{$name} = $value;
                        break;
                }
            } else {
                $model->{$name} = $value;
            }
        }
    }

    public function validate()
    {

        $rules      = [];
        $attributes = [];

        foreach ($this->fields() as $field) {
            $fieldRules = $field->rules();
            if (!empty($fieldRules)) {
                $rules[$field->name()]      = $fieldRules;
                $attributes[$field->name()] = $field->getLabel();
            }
        }

        $data = request()->all();

        $messages = $this->get('messages', []);

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this;
    }
}
