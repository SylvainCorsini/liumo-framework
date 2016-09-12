<?php

/*
 * Application Routes
 ********************
 *
 * Here is where you can register all of the routes for your application.
 *
 */

return array(
    array(
        'GET', '/[{test}]', ['TestController', 'index'], ['TestMiddleware']
    )
);
