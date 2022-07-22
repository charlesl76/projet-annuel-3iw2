<?php

namespace App\Core;

/**
 * Logger class
 * Singleton using lazy instantiation
 */
class Logger
{
    private static $instance = NULL;

    public function __construct()
    {
        /** */

    }

    /**
     * Gets instance of the Logger
     * @return Logger instance
     * @access public
     */
    public static function getInstance() 
    {
        if (is_null(self::$instance)) {
            self::$instance = fopen('./logs.log', 'a');
        }
        return self::$instance;
    }

    public static function writeLog(string $message)
    {
        $currentTime = date('[Y/m/d, H:i:s]');

        $instance = self::getInstance();
        fwrite($instance, "[$currentTime]: $message\n");
    }

    public function __destruct()
    {
        $instance = self::getInstance();
        fclose($instance);
    }


};
