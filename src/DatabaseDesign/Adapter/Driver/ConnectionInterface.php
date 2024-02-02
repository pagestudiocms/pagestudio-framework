<?php 

namespace Ps\Framework\Database\Driver;

interface ConnectionInterface
{
    public function getResource();

    public function getCurrentSchema();

    /**
     * @return ResultInterface
     */
    public function execute($sql);
}