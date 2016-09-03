<?php
namespace Src\Container;

/**
 * This class gives the ability to access non-static methods statically
 *
 * Class AliasFacade
 */
class AliasFacade {

    /**
     * @var Container
     */
    protected static $containerInstance;

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        if(!static::$containerInstance) {
            static::$containerInstance = new Container();
        }

        return call_user_func_array(array(static::$containerInstance, $method), $args);
    }

    /**
     * @param Container $instance
     */
    public static function setContainerInstance(Container $instance)
    {
        static::$containerInstance = $instance;
    }

    /**
     * @return Container $instance
     */
    public static function getContainerInstance()
    {
        return static::$containerInstance;
    }
}