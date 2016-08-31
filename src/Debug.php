<?php
error_reporting(E_ALL);

$whoops = new \Whoops\Run;
if (DEVELOPMENT_ENVIRONMENT === true) {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function () use ($response, $renderer) {
        if ($response->getStatusCode() != 200) {
            if (file_exists('../app/views/errors/' . $response->getStatusCode() . '.html')) {
                $renderer->draw('errors/' . $response->getStatusCode(), false);
            } else {
                echo '<h1>Error ' . $response->getStatusCode() . '</h1>';
            }
        } else {
            echo 'An unknown error occured.';
        }
    });
}
$whoops->register();