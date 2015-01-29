<?php
namespace ecciss;

class Renderer
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function render()
    {
        $file = dirname(__FILE__) . '/views/index.phtml';
        if (file_exists($file)) {
            $this->partial('index.phtml');
        } else {
            $this->getContent();
        }
    }

    public function partial($path)
    {
        include_once dirname(__FILE__) . '/views/' . $path;
    }

    public function getContent()
    {
        $this->partial($this->view);
    }
}