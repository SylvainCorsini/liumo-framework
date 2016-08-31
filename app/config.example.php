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

const ORM_DRIVER = 'mysql';
const ORM_SETTINGS = array(
    'dbname' => 'mydb',
    'user' => 'user',
    'password' => 'secret',
    'host' => 'localhost',
    'driver' => 'pdo_' . ORM_DRIVER
);