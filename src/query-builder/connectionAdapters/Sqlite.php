<?php
namespace Src\QueryBuilder\ConnectionAdapters;

class Sqlite extends BaseAdapter
{
    /**
     * @param $config
     *
     * @return mixed
     */
    public function doConnect($config)
    {
        $connectionString = 'sqlite:' . $config['database'];
        return $this->container->build(
            '\PDO',
            array($connectionString, null, null, $config['options'])
        );
    }
}
