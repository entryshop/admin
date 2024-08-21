<?php

namespace Entryshop\Admin\Admin;

class ActionResponse
{
    protected $response;
    protected $data = [];

    protected $status_code = 200;

    public function __construct($response = null)
    {
        $this->response = $response ?? response();
    }

    public function send()
    {
        return $this->response->json($this->data, $this->status_code);
    }

    public function toJson()
    {
        return $this->data;
    }

    public function redirect($url)
    {
        $this->data['action'] = 'redirect';
        $this->data['url']    = $url;
        return $this;
    }

    public function logout()
    {
        $this->data['action'] = 'logout';
        return $this;
    }

    public function refresh()
    {
        $this->data['action'] = 'refresh';
        return $this;
    }

    public function delay($milliseconds = 1000)
    {
        $this->data['delay'] = $milliseconds;
        return $this;
    }

    public function error()
    {
        $this->status_code = 500;
        return $this;
    }

    public function message($text, $type = 'success')
    {
        $this->data['action'] = 'message';
        $this->data['text']   = $text;
        $this->data['type']   = $type;
        return $this;
    }

    public function alert($title, $text = '', $icon = 'success')
    {
        $this->data['action'] = 'alert';
        $this->data['text']   = $text;
        $this->data['title']  = $title;
        $this->data['icon']   = $icon;
        return $this;
    }
}
