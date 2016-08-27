<?php
namespace Core;

use Pixie\Connection;
use Pixie\QueryBuilder\QueryBuilderHandler;

class ModelCore
{
    public $connection;
    public $db;

    public function __construct()
    {
        $this->connection = new Connection(DB_DRIVER, DB_CONFIG, 'DB');
        $this->db = new QueryBuilderHandler();
    }
}