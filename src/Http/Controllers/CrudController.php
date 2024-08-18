<?php

namespace Entryshop\Admin\Http\Controllers;

use Entryshop\Admin\Crud\CrudPanel;
use Entryshop\Admin\Support\CanCallMethods;

abstract class CrudController
{
    use CanCallMethods;

    /**
     * @var CrudPanel crud panel
     */
    protected $_crud;

    /**
     * @var string model class name
     */
    public $model;

    /**
     * @var string route prefix
     */
    public $route;

    /**
     * @var string translation file path
     */
    public $lang;

    /**
     * @var array first for singular, second for plural
     */
    public $labels = [];

    /**
     * @var array context data
     */
    public $data = [];

    public function __construct()
    {
        $this->__callMethods('setup');
    }

    protected function getCrudDefaults()
    {
        return [
            'model' => $this->model,
            'route' => $this->route,
            'lang'  => $this->lang,
        ];
    }

    public function crud()
    {
        if (empty($this->_crud)) {
            $this->_crud = crud($this->getCrudDefaults());
            $this->crud()->labels($this->labels[0] ?? $this->crud()->trans('label'), $this->labels[1] ?? $this->crud()->trans('labelPlural'));
        }
        return $this->_crud;
    }

    public function redirect($url)
    {
        return admin()->redirect($url);
    }

    protected function _before($action = null, ...$args)
    {
        $this->__callMethods('before', $action ?? $this->data['action'], ...$args);
    }

    protected function _after($action = null, ...$args)
    {
        $this->__callMethods('after', $action ?? $this->data['action'], ...$args);
    }

}
