<?php

const DEVELOPMENT_ENVIRONMENT = true;
const BASE_URL = __DIR__.'/../';

const DB_DRIVER = 'mysql';
const DB_CONFIG = array(
    'driver'    => DB_DRIVER,
    'host'      => 'localhost',
    'database'  => 'minimis',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'options'   => array(
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_EMULATE_PREPARES => true,
    )
);
