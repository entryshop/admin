<?php

namespace Entryshop\Admin\Support;

trait HasVariables
{
    protected $variables = [];
    protected $original_variables = [];
    private $__built = false;

    public function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $_key => $_value) {
                $this->set($_key, $_value);
            }
            return $this;
        }
        $this->variables[$key] = $value;
        return $this;
    }

    public function get($key, $default = null)
    {
        return evaluate($this->variables[$key] ?? $default, $this->renderable ?? $this);
    }

    public function has($key): bool
    {
        return array_key_exists($key, $this->variables);
    }

    public function push($key, $value)
    {
        if (!is_array($value)) {
            $value = [$value];
        }
        $this->variables[$key] = array_merge($this->variables[$key] ?? [], $value);
        return $this;
    }

    public function getOrPush($key, $value = null)
    {
        if (empty($value)) {
            return array_unique($this->get($key, []));
        }

        return $this->push($key, $value);
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
}
