<?php

namespace Entryshop\Admin\Http\Controllers;

use Illuminate\Support\Str;

abstract class CrudController
{
    protected $_crud;

    public $model;
    public $route;
    public $lang;
    public $label;
    public $labelPlural;

    public $data = [];

    public function __construct()
    {
        $this->setup();
    }

    public function setup()
    {
    }

    public function index()
    {
        $this->data['action'] = 'index';

        $this->_before();

        admin()->title($this->crud()->labelPlural());
        $this->crud()->table()->applyFilters();
        admin()->child($this->crud());

        $this->_after();

        return admin()->render();
    }

    public function create()
    {
        $this->data['action'] = 'create';
        $this->_before();

        admin()->title(__('admin::crud.create') . ' ' . $this->crud()->label())
            ->back($this->crud()->url());
        $this->crud()->action($this->crud()->url());
        $this->crud()->method('post');
        $this->crud()->form();
        admin()->child($this->crud());

        $this->_after();
        return admin()->render();
    }

    public function store()
    {
        $this->_before('form');
        $this->_before('store');

        $this->crud()->validate();
        $this->crud()->store();

        $this->_after('form');
        $this->_after('store');
        return redirect($this->crud()->url());
    }

    public function edit($id)
    {
        $this->data['action'] = 'edit';
        $this->data['id']     = $id;

        $this->_before();

        admin()->title(__('admin::crud.edit') . ' ' . $this->crud()->label())
            ->back($this->crud()->url());
        $this->crud()->findOrFail($id);
        $this->crud()->action($this->crud()->url($id));
        $this->crud()->method('put');
        $this->crud()->form();
        admin()->child($this->crud());

        $this->_after();

        return admin()->render();
    }

    public function update($id)
    {
        $this->data['action'] = 'update';
        $this->data['id']     = $id;

        $this->_before();

        $this->crud()->findOrFail($id);
        $this->crud()->validate();
        $this->crud()->save();

        $this->_after();
        return redirect($this->crud()->url());
    }

    public function show($id)
    {
        $this->data['action'] = 'show';
        $this->data['id']     = $id;

        $this->_before();

        admin()->title($this->crud()->label() . ' 详情')
            ->back($this->crud()->url());
        $this->crud()->findOrFail($id);
        $this->crud()->show();
        admin()->child($this->crud());

        $this->_after();

        return admin()->render();
    }

    public function destroy($id)
    {
        $this->crud()->findOrFail($id);
        $this->crud()->entry()->delete();

        if (request()->ajax()) {
            return admin()->response()->refresh()->send();
        }
        return redirect($this->crud()->url());
    }

    protected function _call($stag, $action, ...$args)
    {
        $action = Str::studly($action);
        foreach (get_class_methods($this) as $method) {
            if (Str::startsWith($method, $stag) && Str::endsWith($method, $action)) {
                $this->{$method}(...$args);
            }
        }
    }

    protected function _before($action = null, ...$args)
    {
        $this->_call('before', $action ?? $this->data['action'], ...$args);
    }

    protected function _after($action = null, ...$args)
    {
        $this->_call('after', $action ?? $this->data['action'], ...$args);
    }


    protected function getCrudDefaults()
    {
        return [
            'model'       => $this->model,
            'route'       => $this->route,
            'lang'        => $this->lang,
            'label'       => $this->label,
            'labelPlural' => $this->labelPlural,
        ];
    }

    public function crud()
    {
        return $this->_crud ??= crud($this->getCrudDefaults());
    }

}
