<?php 

namespace Ps\Framework\Database\Adapter\Driver;

interface DriverInterface 
{
    const ISO_DATE_FORMAT = 'yyyy-MM-dd';
    const ISO_DATETIME_FORMAT = 'yyyy-MM-dd HH-mm-ss';
    const QUERY_MODE_EXECUTE = 'execute';
    const QUERY_MODE_PREPARE = 'prepare';

    /**
     * Check environment
     *
     * @return bool
     */
    public function checkEnvironment();

    public function connect();

    /**
     * Prepares and executes an SQL statement with bound data.
     *
     * @param  mixed $sql The SQL statement with placeholders.
     *                      May be a string or \Magento\Framework\DB\Select.
     * @param  mixed $bind An array of data or data itself to bind to the placeholders.
     * @return \Zend_Db_Statement_Interface
     */
    public function query($sql, $bind = []);

    /**
     * Get connection
     *
     * @return ConnectionInterface
     */
    public function getConnection();

    /**
     * @return Driver\DriverInterface
     */
    public function getDriver();

    /**
     * @return Platform\PlatformInterface
     */
    public function getPlatform();
}
