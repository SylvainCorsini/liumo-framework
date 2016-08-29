<?php
namespace Core\TemplateEngine;

class AliasFacade
{
    /**
     * @var TemplateEngine
     */
    protected static $rainInstance;

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        if (!static::$rainInstance) {
            static::$rainInstance = new TemplateEngine();
        }

        // Call the non-static method from the class instance
        return call_user_func_array(array(static::$rainInstance, $method), $args);
    }
}
