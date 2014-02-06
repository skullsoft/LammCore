<?php

namespace LammCore\Db\Sql;

use Zend\Db\Sql\SqlInterface;
use Zend\Db\Sql\PreparableSqlInterface;
use Zend\Db\Adapter\Platform\PlatformInterface;
use Zend\Db\Sql\Sql as ZendSql,
    Core\Db\Sql\Select as CoreSelect;

class Sql extends ZendSql
{

    public function select($table = null)
    {
        if ($this->table !== null && $table !== null) {
            throw new Exception\InvalidArgumentException(sprintf(
                'This Sql object is intended to work with only the table "%s" provided at construction time.',
                $this->table
            ));
        }

        return new CoreSelect(($table) ?: $this->table);
    }

    public function prepareStatementForSqlObject(PreparableSqlInterface $sqlObject, StatementInterface $statement = null)
    {
        $statement = ($statement) ?: $this->adapter->getDriver()->createStatement();

        if ($this->sqlPlatform) {
            $this->sqlPlatform->setSubject($sqlObject);
            $this->sqlPlatform->prepareStatement($this->adapter, $statement);
        } else {
            $sqlObject->prepareStatement($this->adapter, $statement);
        }

        return $statement;
    }

    public function getSqlStringForSqlObject(SqlInterface $sqlObject, PlatformInterface $platform = null)
    {
        $platform = ($platform) ?: $this->adapter->getPlatform();

        if ($this->sqlPlatform) {
            $this->sqlPlatform->setSubject($sqlObject);
            $sqlString = $this->sqlPlatform->getSqlString($platform);
        } else {
            $sqlString = $sqlObject->getSqlString($platform);
        }

        return $sqlString;
    }

}
