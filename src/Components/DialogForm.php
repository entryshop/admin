<?php

namespace Entryshop\Admin\Components;

use Entryshop\Utils\Components\Renderable;
use Entryshop\Utils\Support\CanCallMethods;

abstract class DialogForm extends Renderable
{
    use CanCallMethods;

    protected $crud;
    protected $data;
    protected $fullscreen = true;

    abstract function form();

    public function submit()
    {
        $this->save();

        return $this->returnAction();
    }

    public function returnAction($action = [], $close = true)
    {
        admin()->child(renderable()->view('admin::partials.dialog_action_scripts'));
        admin()->guest();
        return admin()->render([
            'close'  => $close,
            'action' => $action,
        ]);
    }

    public function save()
    {
        $this->form();
        $this->crud()->validate();
        $this->crud()->save();
    }

    public function show()
    {
        $this->form();
        if ($this->fullscreen) {
            admin()->guest();
        }
        admin()->child($this->crud());
        return admin()->render($this->data);
    }

    protected function crud()
    {
        if (empty($this->crud)) {
            $crud = crud();
            $crud->form();
            $crud->action(route('admin.form.submit', array_merge(['form' => static::class], request()->all())));
            $this->crud = $crud;
        }

        return $this->crud;
    }

}
