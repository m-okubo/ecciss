<?php
namespace ecciss;

class Logger
{
    const ERROR   = 1;
    const WARNING = 2;
    const INFO    = 3;
    const DEBUG   = 4;

    private static $log;
    private $level;
    private $destination;

    public static function getInstance($level = Logger::INFO, $destination = null) {
        if (empty(self::$log)) {
            if (empty($destination)) {
                $destination = PROJECT_ROOT . '/ecciss.log';
            }
            self::$log = new Logger($level, $destination);
        }

        return self::$log;
    }

    private function __construct($level, $destination) {
        $this->level = $level;
        $this->destination = $destination;
    }

    public function error($message)
    {
        $this->log('ERROR', $message);
    }

    public function warning($message)
    {
        $this->log('WARNING', $message);
    }

    public function info($message)
    {
        $this->log('INFO', $message);
    }

    public function debug($message)
    {
        $this->log('DEBUG', $message);
    }

    private function log($level_name, $message)
    {
        if ($this->level < constant(__CLASS__ . '::' . $level_name)) {
            return;
        }

        $line  = date('Y-m-d H:i:s');
        $line .= "\t[" . $level_name . "]";
        $line .= "\t" . $message;
        $line .= "\n";

        error_log($line, 3, $this->destination);
    }
}