<?php

namespace Entryshop\Admin\Crud\Traits;

use Entryshop\Admin\Crud\CrudField;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * @method string|self action($value = null)
 * @method string|self method($value = null)
 * @method string|self messages($value = null)
 */
trait HasFields
{

    /**
     * @param ...$args
     * @return CrudField
     */
    public function field(...$args)
    {
        $cell = CrudField::make(...$args);
        $cell->crud($this);
        $this->child($cell);
        return $cell;
    }

    public function fields(...$args)
    {
        if (!count($args)) {
            $fields = $this->getFieldsFromRenderable($this);
//            foreach ($fields as $field) {
//                $field->crud($this);
//            }
            return $fields;
        }

        $value = $args[0];
        if (is_array($value)) {
            foreach ($value as $cell) {
                $this->field($cell);
            }
        }
        return $this;
    }

    public function store()
    {
        $model = app($this->get('model'));
        $this->saving($model);
        $model->save();
        return $this;
    }

    public function save()
    {
        $model = $this->entity();
        $this->saving($model);
        $model->save();
        return $this;
    }

    public function getFieldsFromRenderable($renderable)
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
