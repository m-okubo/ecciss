<?php
namespace ecciss;

class Controller
{
    public function execute()
    {
        $dirs = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        array_shift($dirs);
        $page = empty($dirs[0]) ? 'login' : $dirs[0];
        $action = empty($dirs[1]) ? 'index' : $dirs[1];

        $model_name  = strtoupper(substr($page, 0, 1));
        $model_name .= substr($page, 1);
        $model_name .= 'Model';

        // Dynamic class name is regarded as a fully qualified name.
        $class_name = '\\ecciss\\models\\' . $model_name;
        $model = new $class_name();

        $action_name = $action . 'Action';

        $log = Logger::getInstance();
        $log->info($model_name . '->' . $action_name . '() start');
        $model->$action_name();
        $log->info($model_name . '->' . $action_name . '() end');

        $renderer = new Renderer($model, $page, $action);
        $renderer->render();
    }
}
