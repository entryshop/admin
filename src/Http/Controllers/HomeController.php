<?php


namespace Entryshop\Admin\Http\Controllers;

class HomeController
{
    public function __invoke()
    {
        admin()->child('Welcome');
        return admin()->render();
    }
}
