<?php

/*
 *  (c) 2016. SMSGH
 */

namespace HubtelUssdFramework;

/**
 * Abstraction of logging functionality.
 *
 * @author Aaron
 */
class Loggers {
    
    /**
     *
     * @var callable
     */
    private static $_debugLogger;
    
    /**
     *
     * @var callable
     */
    private static $_errorLogger;
    
    static function getDebugLogger() {
        return Loggers::$_debugLogger;
    }
    
    static function setDebugLogger($debugPath) {
        // Loggers::$_debugLogger = $debugLogger;
        Loggers::$_debugLogger = self::customDebugLogger($debugPath);
    }
    
    static function getErrorLogger() {
       return Loggers::$_errorLogger;
    }
    
    static function setErrorLogger($errorPath) {
       // Loggers::$_errorLogger = $errorLogger;
        Loggers::$_errorLogger = self::customDebugLogger($errorPath);
    }

    static function customDebugLogger($logPath)
    {
        $log = new BaseLog($logPath, 'ussd-framework-logger');
        $log->debug(func_get_args());
    }

    static function customErrorLogger($logPath)
    {
        $log = new BaseLog($logPath, 'ussd-framework-logger');
        $log->error(func_get_args());
    }
}
