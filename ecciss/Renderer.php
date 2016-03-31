<?php
namespace ecciss;

class Renderer
{
    private $model;
    private $page;
    private $view;
    private $labels;
    private $errors;

    public function __construct($model, $page, $action)
    {
        $this->model = $model;
        $this->page = $page;
        $this->labels = $this->model->getLabels();
        $this->errors = $this->model->getErrors();

        $view = $this->model->getView();
        if (empty($view)) {
            $this->view = $page . '/' . $action;
        } else {
            $this->view = $view;
        }
        $this->view .= '.phtml';
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

    public function getUrl($url)
    {
        if (strpos($url, '.') === false) {
            $url = APP_ROOT . '/' . $url;
        } else {
            $url = WEB_ROOT . '/' . $url;
        }

        return $url;
    }
}
