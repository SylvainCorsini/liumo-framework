<?php
namespace Src\Routing;

spl_autoload_register(function ($class) {
    if (strpos($class, '\\Src\\Routing\\') === 0) {
        $name = substr($class, strlen('\\Src\\Routing'));
        require __DIR__ . strtr($name, '\\', DIRECTORY_SEPARATOR) . '.php';
    }
});
