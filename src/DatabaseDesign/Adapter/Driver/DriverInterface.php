<?php 

namespace Ps\Framework\Database\Adapter\Driver;

interface DriverInterface 
{
    /**
     * Check environment
     *
     * @return bool
     */
    public function checkEnvironment();

    /**
     * Get connection
     *
     * @return ConnectionInterface
     */
    public function getConnection();

    /**
     * Get last generated value
     *
     * @return mixed
     */
    public function getLastGeneratedValue();
}