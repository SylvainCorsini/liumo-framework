<?php
namespace Src\QueryBuilder\QB\Adapters;

class Mysql extends BaseAdapter
{
    /**
     * @var string
     */
    protected $sanitizer = '`';
}
