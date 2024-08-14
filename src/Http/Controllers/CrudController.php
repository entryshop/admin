<?php

namespace Entryshop\Admin\Http\Controllers;

use Illuminate\Support\Str;

abstract class CrudController
{
    protected $_crud;

    public function __construct()
    {
        $this->setup();
    }

    abstract public function setup();

    public function index()
    {
        $this->_before('columns');
        $this->_before('index');

        admin()->title($this->crud()->title() . ' 列表');
        $this->crud()->table()->applyFilters();
        admin()->child($this->crud());

        $this->_after('columns');
        $this->_after('index');
        return admin()->render();
    }

    public function create()
    {
        $this->_before('form');
        $this->_before('create');

        admin()->title('新建 ' . $this->crud()->label())
            ->back($this->crud()->url());
        $this->crud()->action($this->crud()->url());
        $this->crud()->method('post');
        $this->crud()->form();
        admin()->child($this->crud());

        $this->_after('form');
        $this->_after('create');
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
        $this->_before('form', $id);
        $this->_before('edit', $id);

        admin()->title('编辑 ' . $this->crud()->label())
            ->back($this->crud()->url());
        $this->crud()->findOrFail($id);
        $this->crud()->action($this->crud()->url($id));
        $this->crud()->method('put');
        $this->crud()->form();
        admin()->child($this->crud());

        $this->_after('form', $id);
        $this->_after('edit', $id);
        return admin()->render();
    }

    public function update($id)
    {
        $this->_before('form', $id);
        $this->_before('update', $id);

        $this->crud()->findOrFail($id);
        $this->crud()->validate();
        $this->crud()->save();

        $this->_after('form', $id);
        $this->_after('update', $id);
        return redirect($this->crud()->url());
    }

    public function show($id)
    {
        $this->_before('columns', $id);
        $this->_before('show', $id);

        admin()->title($this->crud()->label() . ' 详情')
            ->back($this->crud()->url());
        $this->crud()->findOrFail($id);
        $this->crud()->show();
        admin()->child($this->crud());

        $this->_after('columns', $id);
        $this->_after('show', $id);
        return admin()->render();
    }

    public function destroy($id)
    {
        $this->crud()->findOrFail($id);
        $this->crud()->entry()->delete();
        return admin()->response()->refresh()->send();
    }

    public function crud()
    {
        return $this->_crud ??= crud();
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

    protected function _before($action, ...$args)
    {
        $this->_call('before', $action, ...$args);
    }

    protected function _after($action, ...$args)
    {
        $this->_call('after', $action, ...$args);
    }

}
