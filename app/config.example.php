<?php

const DEVELOPMENT_ENVIRONMENT = true;
const DEFAULT_URI = '/minimis/public';

const RENDERER_SETTINGS = array(
    'checksum' => array(),
    'charset' => 'UTF-8',
    'debug' => false,
    'tpl_dir' => '../app/views/',
    'cache_dir' => '../cache/',
    'tpl_ext' => 'html',
    'base_url' => DEFAULT_URI,
    'php_enabled' => false,
    'auto_escape' => true,
    'sandbox' => true,
    'remove_comments' => false,
    'registered_tags' => array()
);

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