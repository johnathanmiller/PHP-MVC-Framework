<?php

class MySQL
{

    protected $handler;
    protected $stmt;

    public function __construct(
        string $host,
        int $port,
        string $user,
        string $pass,
        string $name
    ) {
        $dsn = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $name . ';charset=utf8';
        $options = [
            \PDO::ATTR_PERSISTENT => false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->handler = new \PDO($dsn, $user, $pass, $options);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query($query) : void
    {
        $this->stmt = $this->handler->prepare($query);
    }

    public function bind($param, $value, $type = null) : void
    {
        if (is_null($type)) {
            switch (true) {
                case is_numeric($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function bindArray($array) : void
    {
        foreach ($array as $k => $v) {
            $this->bind($k, $v);
        }
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        $this->execute();
        return $this->stmt->rowCount();
    }

    public function lastInsertId()
    {
        return $this->handler->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->handler->beginTransaction();
    }

    public function endTransaction()
    {
        return $this->handler->commit();
    }

    public function cancelTransaction()
    {
        return $this->handler->rollBack();
    }

    public function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }

}