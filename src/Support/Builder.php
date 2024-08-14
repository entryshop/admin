<?php

namespace Entryshop\Admin\Support;

use Illuminate\Support\Str;

/**
 * @method string|self view($value = null)
 * @method string|self key($value = null)
 */
class Builder
{
    use Makable;

    protected $variables = [];
    protected $original_variables = [];

    protected $renderable;

    private $__built = false;

    public function __construct(Renderable $renderable, ...$args)
    {
        $this->renderable = $renderable;
        if (!empty($args[0]) && is_array($args[0])) {
            foreach ($args[0] as $key => $value) {
                $this->set($key, $value);
            }
        }
    }

    public function renderable($value = null)
    {
        if (!empty($value)) {
            $this->renderable = $value;
        }
        return $this->renderable;
    }

    public function set($key, $value)
    {
        if (!empty($this->renderable)) {
            $set_method = 'set' . Str::studly($key);
            if (method_exists($this->renderable, $set_method)) {
                $this->renderable->{$set_method}($value);
            }
        }

        $this->variables[$key] = $value;
        return $this->renderable ?? $this;
    }

    public function get($key, $default = null)
    {
        return evaluate($this->variables[$key] ?? $default, $this->renderable ?? $this);
    }

    public function push($key, $value)
    {
        if (!is_array($value)) {
            $value = [$value];
        }
        $this->variables[$key] = array_merge($this->variables[$key] ?? [], $value);
        return $this->renderable ?? $this;
    }

    public function getOrPush($key, $value = null)
    {
        if (empty($value)) {
            return array_unique($this->get($key, []));
        }

        return $this->push($key, $value);
    }

    public function has($key): bool
    {
        return array_key_exists($key, $this->variables);
    }

    public function variables()
    {
        if ($this->__built) {
            return $this->variables;
        }
        $this->buildVariables();
        return $this->variables;
    }

    protected function buildVariables()
    {
        $this->original_variables = $this->variables;
        $built_variable           = [];
        foreach ($this->variables as $key => $variable) {
            $built_variable[$key] = evaluate($variable, $this->renderable ?? $this);
        }
        $this->variables = $built_variable;
        $this->__built   = true;
    }

    public function __call($name, $arguments)
    {
        if (count($arguments) === 1) {
            return $this->set($name, $arguments[0]);
        }

        if (count($arguments) === 0) {
            return $this->get($name);
        }

        return $this->renderable ?? $this;
    }
}
