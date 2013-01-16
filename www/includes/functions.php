<?php

/**
 * Custom error handler. The errors are pushed to $message[]
 */
function errorHandler($errno, $errstr, $errfile, $errline)
{
        global $message;

        $mask = ini_get('error_reporting');

        $class = 'error';

        // If mask for this error is not enabled, return silently
        if (!($errno & $mask)) {
                return true;
        }

        // Remove any preceding path until viewgit's directory
        $file = $errfile;
//        $file = strstr($file, 'viewgit/');

        $message = "$file:$errline $errstr [$errno]";

        switch ($errno) {
                case E_ERROR:
                        $class = 'error';
                        break;
                case E_WARNING:
                        $class = 'warning';
                        break;
                case E_NOTICE:
                case E_STRICT:
                default:
                        $class = 'info';
                        break;
        }

        $notices[] = array(
                'message' => $message,
                'class' => $class,
        );

        return true;
}

?>
