<?php

namespace Entryshop\Admin\Components\Crud\Columns;

use Entryshop\Admin\Components\Crud\CrudColumn;

/**
 * @method self defaultImageUrl($value) Default image url when no image is available
 * @method self limit($value) Limit the number of images to display
 */
class ImageColumn extends CrudColumn
{
    protected $view_namespace = 'admin::crud.columns.';
    protected $default_type = 'image';

    /**
     * Set max width and height
     */
    public function size($value)
    {
        $this->set('width', $value);
        $this->set('height', $value);
        return $this;
    }

    /**
     * Display images in a stack
     */
    public function stack($value = true)
    {
        return $this->set('stack', $value);
    }
}
