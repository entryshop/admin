<?php

namespace Entryshop\Admin\Support;

trait BootTraits
{
    public function boot()
    {
        $self = static::class;
        foreach (class_uses_recursive($self) as $trait) {
            if (method_exists($self, $method = 'boot' . class_basename($trait))) {
                $this->$method();
            }
        }
    }

    public function register(...$args)
    {
        $self = static::class;
        foreach (class_uses_recursive($self) as $trait) {
            if (method_exists($self, $method = 'register' . class_basename($trait))) {
                $this->$method(...$args);
            }
        }
    }
}
