<?php 

namespace Ps\Framework\Database\Adapter\Driver\Pdo;

class Statement
{
    protected $pdo = null;

    protected $driver = null;

    protected $sql = ''; 

    protected $resource = null;

    public function setDriver(Pdo $driver)
    {
        $this->driver = $driver;
        return $this;
    }

    public function init(\PDO $connectionResource)
    {
        $this->pdo = $connectionResource;
        return $this;
    }

    /**
     * Get resource
     *
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set sql
     *
     * @param string $sql
     * @return Statement
     */
    public function setSql($sql)
    {
        $this->sql = $sql;
        return $this;
    }

    /**
     * Get sql
     *
     * @return string
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * @param string $sql
     * @throws Exception\RuntimeException
     */
    public function prepare($sql = null)
    {
        if ($this->isPrepared) {
            throw new Exception\RuntimeException('This statement has been prepared already');
        }

        if ($sql === null) {
            $sql = $this->sql;
        }

        $this->resource = $this->pdo->prepare($sql);

        if ($this->resource === false) {
            $error = $this->pdo->errorInfo();
            throw new Exception\RuntimeException($error[2]);
        }

        $this->isPrepared = true;
    }

    /**
     * @return bool
     */
    public function isPrepared()
    {
        return $this->isPrepared;
    }

    /**
     * @param null|array|ParameterContainer $parameters
     * @throws Exception\InvalidQueryException
     * @return Result
     */
    public function execute($parameters = null)
    {
        if (!$this->isPrepared) {
            $this->prepare();
        }
    }
}