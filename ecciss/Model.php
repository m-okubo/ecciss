<?php
namespace ecciss;

class Model
{
    private $view;
    private $layout;

    public function getView()
    {
        return $this->view;
    }

    public function setView($view)
    {
        $this->view = $view;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function redirect($url)
    {
        header('Location: ' . APP_ROOT . '/' . $url);
        exit();
    }
}
