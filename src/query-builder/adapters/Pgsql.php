<?php
namespace Src\QueryBuilder\Adapters;

class Pgsql extends BaseAdapter
{
    /**
     * @var string
     */
    protected $sanitizer = '"';
}
