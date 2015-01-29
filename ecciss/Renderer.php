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
        $layout = $this->model->getLayout();
        if (empty($layout)) {
            $this->getContent();
        } else {
            $this->partial($layout);
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