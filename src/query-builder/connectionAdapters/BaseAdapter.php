<?php
namespace Scorsi\QueryBuilder\ConnectionAdapters;

abstract class BaseAdapter
{
    /**
     * @var \Scorsi\Container\Container
     */
    protected $container;

    /**
     * @param \Scorsi\Container\Container $container
     */
    public function __construct(\Scorsi\Container\Container $container)
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
