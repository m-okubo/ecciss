<?php
/*
 * Here is a starting point of all requests for ecciss.
 */
try
{
    // Define constants
    define('PROJECT_ROOT', dirname(dirname(__FILE__)));
    define('RESOURCES_ROOT', PROJECT_ROOT . '/ecciss/resources');
    define('WEB_ROOT', dirname($_SERVER['SCRIPT_NAME']));
    define('APP_ROOT', dirname(WEB_ROOT));

    // Load config
    $config = parse_ini_file(RESOURCES_ROOT . '/config.ini');
    $config = parse_ini_file(RESOURCES_ROOT . '/' . $config['FILE_NAME']);

    foreach ($config as $key => $value) {
        define($key, $value);
    }

    // Set error level
    error_reporting(ERROR_LEVEL);

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
