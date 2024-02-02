<?php 

namespace Ps\Framework\Database\Adapter\Driver\Pdo;

use Ps\Framework\Database\Adapter\Driver\DriverInterface;
use PDOStatement;

class MysqlDriver implements DriverInterface
{
    protected $connection; 

    protected $statement;

    public function __construct($connection)
    {
        $this->registerConnection($connection);
    }
}