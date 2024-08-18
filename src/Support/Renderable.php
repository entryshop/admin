<?php

namespace Entryshop\Admin\Support;

/**
 * @method string|self view($value = null) Get/set view file
 * @method string|self display($value = null) Get/set display content
 */
class Renderable
{
    use BootTraits;
    use Makable;
    use HasChildren;
    use HasAttributes;
    use HasVariables;

    protected $default_view;

    public function __construct(...$args)
    {
        $this->register(...$args);
        if (!empty($args[0]) && is_array($args[0])) {
            foreach ($args[0] as $key => $value) {
                $this->set($key, $value);
            }
        }
    }

    public function render(...$args)
    {
        $this->boot();
        if ($this->has('display')) {
            return $this->get('display');
        }
        return view($this->getView(...$args), $this->getViewData(...$args));
    }

    public function __call($name, $arguments)
    {
        if (count($arguments) === 1) {
            return $this->set($name, $arguments[0]);
        }

        if (count($arguments) === 0) {
            return $this->get($name);
        }

        return $this;
    }

    public function getView(...$args)
    {
        return $this->view() ?? $this->default_view;
    }

    public function getViewData(...$args)
    {
        $data = [
            'renderable' => $this,
        ];
        $this->boot();
        if (!empty($args[0]) && is_array($args[0])) {
            $data = array_merge($data, $args[0]);
        }
        return array_merge($data, $this->variables());
    }
}
