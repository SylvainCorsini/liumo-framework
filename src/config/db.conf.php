<?php
const DB_DRIVER = 'mysql';

/* if DB_DRIVER === 'mysql' */
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
/* if DB_DRIVER === 'sqlite' */
/*
const DB_CONFIG = array(
    'driver'   => DB_DRIVER,
    'database' => 'your-file.sqlite',
    'prefix'   => 'cb_',
);
*/
/* if DB_CONFIG === 'pgsql' */
/*
const DB_CONFIG = array(
    'driver'   => DB_DRIVER,
    'host'     => 'localhost',
    'database' => 'your-database',
    'username' => 'postgres',
    'password' => 'your-password',
    'charset'  => 'utf8',
    'prefix'   => 'cb_',
    'schema'   => 'public',
);
*/