<?php
/*
 * Here is a starting point of all requests for ecciss.
 */
try
{
    // Define constants
    $project_root = strtr(__FILE__, DIRECTORY_SEPARATOR, '/');
    $project_root = rtrim($project_root, '/public/index.php');
    $web_root = rtrim($_SERVER['SCRIPT_NAME'], '/index.php');

    define('PROJECT_ROOT', $project_root);
    define('WEB_ROOT', $web_root);

    // Load config
    $config_path = '/ecciss/resources/config.ini';
    $config = parse_ini_file(PROJECT_ROOT . $config_path);
    $config_path = '/ecciss/resources/' . $config['FILE_NAME'];
    $config = parse_ini_file(PROJECT_ROOT . $config_path);

    foreach ($config as $key => $value) {
        define($key, $value);
    }

    // Set timezone
    date_default_timezone_set(TIMEZONE);

    // Configure assertion
    assert_options(ASSERT_ACTIVE, ASSERT_ENABLED);

    // Set auto loader
    spl_autoload_register(function($class) {
        $file = PROJECT_ROOT . '/' . strtr($class, '\\_', '//') . '.php';
        if (file_exists($file)) {
            include_once $file;
        } else {
            throw new \Exception('Class: ' . $class . ' not found.');
        }
    });

    // Init Logger
    $level = constant('\\ecciss\\Logger::' . LOG_LEVEL);
    $destination = PROJECT_ROOT . LOG_DESTINATION;
    $logger = \ecciss\Logger::getInstance($level, $destination);
    $logger->debug('Logging start');

    // Start a process
    $controller = new \ecciss\Controller();
    $controller->execute();
}
catch (\Exception $e)
{
    if (isset($logger)) {
        $message  = get_class($e) . ', ';
        $message .= $e->getMessage() . "\n";
        $message .= $e->getTraceAsString();

        $logger->error($message);
    }

    echo $e->getMessage();
}
