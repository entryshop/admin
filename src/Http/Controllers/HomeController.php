<?php

namespace Entryshop\Admin\Http\Controllers;

use Entryshop\Admin\Components\Row;
use Entryshop\Admin\Components\Widget;

class HomeController
{
    public function __invoke()
    {
        admin()->title('Home');

        $widgets  = Row::make();
        $pending  = Widget::make()->type('info')->title('Hello')->value(1)->class('col-md-6 col-lg-3');
        $approved = Widget::make()->type('info')->title('Approved')->value(1)->color('success')->class('col-md-6 col-lg-3');
        $widgets->child($pending)->child($approved);
        return admin()->child($widgets)->render();
    }
}
