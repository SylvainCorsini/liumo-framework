<?php

/*
 * Debug File
 ************
 *
 * This file permits to handle and debug all the Exception.
 *
 */

error_reporting(E_ALL);
ini_set('log_errors', 'On');
ini_set('error_log', __DIR__ . '/../app/log/error.log');

$whoops = new \Whoops\Run;
if (DEVELOPMENT_ENVIRONMENT === true) {
    ini_set('display_errors', 'On');
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    ini_set('display_errors', 'Off');
    $whoops->pushHandler(function () use ($response, $renderer) {
        if ($response->getStatusCode() != 200) {
            if (file_exists('../' . TPL_PATH . ERRORS_TPL_PATH . $response->getStatusCode() . '.' . TPL_EXT)) {
                $renderer->draw(ERRORS_TPL_PATH . $response->getStatusCode(), false);
            } else {
                echo '<h1>Error ' . $response->getStatusCode() . '</h1>';
            }
        } else {
            echo 'An unknown error occured.';
        }
        return $response->returnResponse();
    });
}
$whoops->register();