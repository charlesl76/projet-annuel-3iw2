<?php

/**
 * Logger class
 * Singleton using lazy instantiation
 */
class Logger
{
    private static $instance = NULL;
    private $logs;

    private function __construct() {
        $logs = array();
    }

    /**
     * Gets instance of the Logger
     * @return Logger instance
     * @access public
     */
    public function getInstance() {
        if(self::$instance === NULL) {
            self::$instance = fopen('./errors.log', 'a');
        }
        return self::$instance;
    }


    /**
     * Adds a message to the log
     * @param String $message Message to be logged
     * @access public
     */
    public function log($message) {
        $this->logs[] = $message;
    }

    /**
     * Returns array of logs
     * @return array Array of log messages
     * @access public
     */
    public function get_logs() {
        return $this->logs;
    }

    public function __destruct()
    {
        $instance = self::getInstance();
        fclose($instance);
    }

    public static function wErrorLog(string $message)
    {
        $currentTime = date('[Y/m/d, H:i:s]');

        $instance = self::getInstance();
        fwrite($instance, "[$currentTime]: $message\n");
    }

};