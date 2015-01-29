<?php
namespace ecciss;

class Controller
{
    public function execute()
    {
        $dirs = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        array_shift($dirs);

        if (empty($dirs[0])) {
            $dirs[0] = 'login';
        }
        $model_name  = strtoupper(substr($dirs[0], 0, 1));
        $model_name .= substr($dirs[0], 1);
        $model_name .= 'Model';

        // Dynamic class name is regarded as a fully qualified name.
        $class_name = '\\ecciss\\models\\' . $model_name;
        $model = new $class_name();

        if (!empty($dirs[1])) {
            $action = $dirs[1];
        } else {
            $action = 'index';
        }
        $action_name = $action . 'Action';

        $log = Logger::getInstance();
        $log->info($model_name . '->' . $action_name . '() start');
        $model->$action_name();
        $log->info($model_name . '->' . $action_name . '() end');

        $view = $dirs[0] . '/' . $action . '.phtml';

        $renderer = new Renderer($model, $view);
        $renderer->render();
    }
}
