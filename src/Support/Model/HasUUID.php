<?php

namespace Entryshop\Admin\Support\Model;

use Illuminate\Support\Str;

trait HasUUID
{
    public static function bootHasUUID()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string)Str::orderedUuid();
            }
        });
    }

    public static function findByUuid($uuid)
    {
        return static::where(static::getColumnForQuery('uuid'), $uuid)->first();
    }

}
