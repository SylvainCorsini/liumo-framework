<?php
namespace Core\QueryBuilder\ConnectionAdapters;

abstract class BaseAdapter
{
    /**
     * @var \Core\Container\Container
     */
    protected $container;

    /**
     * @param \Core\Container\Container $container
     */
    public function __construct(\Core\Container\Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param $config
     *
     * @return \PDO
     */
    public function connect($config)
    {
        if (!isset($config['options'])) {
            $config['options'] = array();
        }
        return $this->doConnect($config);
    }

    /**
     * @param $config
     *
     * @return mixed
     */
    abstract protected function doConnect($config);
}
