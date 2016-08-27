<?php
namespace Core\Rain;

class AliasFacade
{
    /**
     * @var Rain
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
            static::$rainInstance = new Rain();
        }

        // Call the non-static method from the class instance
        return call_user_func_array(array(static::$rainInstance, $method), $args);
    }
}
