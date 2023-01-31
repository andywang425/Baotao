<?php
$GLOBALS['error_msgs'] = array();
function error_handler($errno, $errstr, $errfile, $errline)
{
    $log = "[" . date("d-M-Y H:i:s e") . "] PHP ";
    $temp_msg = "<b>";
    $errstr = htmlspecialchars($errstr);
    switch ($errno) {
        case E_USER_ERROR:
            $temp_msg .= "USER ERROR";
            $log .= "User Error";
            break;
        case E_USER_WARNING:
            $temp_msg .= "USER WARNING";
            $log .= "User Warning";
            break;
        case E_USER_NOTICE:
            $temp_msg .= "USER NOTICE";
            break;
        case E_NOTICE:
            $temp_msg .= "NOTICE";
            $log .= "Notice";
            break;
        case E_WARNING:
            $temp_msg .= "WARNING";
            $log .= "Warning";
            break;
        case E_ERROR:
            $temp_msg .= "ERROR";
            $log .= "Error";
            break;
        default:
            $temp_msg .= "OTHER ERROR";
            $log .= "Other Error";
            break;
    }
    $temp_msg .= "</b>: $errfile: $errstr in $errfile on line $errline";
    $log .= ":  " . $errstr . " in " . $errfile . " on line " . $errline;
    error_log($log);
    array_push($GLOBALS['error_msgs'], $temp_msg);
    return true;
}
set_error_handler("error_handler", E_ALL);
