<?php

namespace App\Database;

use PDO;

class MySql
{

    protected $_dbConfig;

    protected $_dbConnection;

    protected $_query;

    protected $_table;

    protected $_where;

    function __construct()
    {
        $this->_dbConfig = include_once(getcwd().'/app/config/database.php');
    }

    /**
     * MYSQL connection function
     * @method _connect
     * @author Matt Stephens <matthewstephens@digidev.co.uk>
     * @return connection   Return a DB connection
     */
    private function _connect()
    {
        $connection = new PDO(
            'mysql:host='.$this->_dbConfig['host'].';dbname='.$this->_dbConfig['database'],
            $this->_dbConfig['username'],
            $this->_dbConfig['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
        return $connection;
    }

    /**
     * Table checker
     * @method _tableExists
     * @author Matt Stephens <matthewstephens@digidev.co.uk>
     * @param  string       $table table to be checked
     */
    private function _tableExists($table)
    {
        $connection = $this->_connect();
        try {
            $tbl = $connection->prepare("SELECT 1 FROM $table LIMIT 1");
            $tbl->execute();
        } catch (Exception $e) {
            var_dump($e);
        }

    }

    /**
     * Main DB save method
     * @method save
     * @author Matt Stephens <matthewstephens@digidev.co.uk>
     * @param  array $data   array of data to be saved
     * @param  string $table table name
     * @return boolean       saved or failed
     */
    public function save($data, $table)
    {
        $this->_dbConnection = $this->_connect();
        $this->_tableExists($table);

        foreach ($data[$table] as $column => $value) {
            $columns[] = $column;
            $values[] = ":$column";
            $toSave[":$column"] = $value;
        }
        $columns = implode(', ', $columns);
        $values = implode(', ', $values);
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        $this->_dbConnection = $this->_dbConnection->prepare($sql);

        $saved = $this->_dbConnection->execute($toSave);

        return $saved;
    }

    /**
     * Get all contacts from DB
     * @method all
     * @author Matt Stephens <matthewstephens@digidev.co.uk>
     * @return array returns array of results
     */
    public function all($table)
    {
        $this->_dbConnection = $this->_connect();
        $this->_tableExists($table);
        $this->_table = $table;

        return $this;
    }

    /**
     * Builder for Where in the main statement
     * @method where
     * @author Matt Stephens <matthewstephens@digidev.co.uk>
     * @param  array $conditions array of where conditions
     * @return object            returns this
     */
    public function where($conditions)
    {
        $sql = "SELECT * FROM $this->_table WHERE ";
        foreach ($conditions as $column => $search) {
            $sql .= $column." = :$column";
            $this->_where[":$column"] = $search;
        }

        $this->_dbConnection = $this->_dbConnection->prepare($sql);

        return $this;
    }

    public function favourite($data, $table)
    {
        $this->_dbConnection = $this->_connect();
        $this->_tableExists($table);
        $this->_dbConnection = $this->_dbConnection->prepare("SELECT favourite FROM $table WHERE id = :id");
        $this->_dbConnection->bindValue(':id', $data[$table]['id']);
        $this->_dbConnection->execute();
        $result = $this->_dbConnection->fetch();

        $this->_dbConnection = $this->_connect();
        if ($result['favourite']) {
            $this->_dbConnection = $this->_dbConnection->prepare("UPDATE $table SET favourite = 0 WHERE id = :id");
        } else {
            $this->_dbConnection = $this->_dbConnection->prepare("UPDATE $table SET favourite = 1 WHERE id = :id");
        }
        $this->_dbConnection->bindValue(':id', $data[$table]['id']);
        $saved = $this->_dbConnection->execute();

        if ($saved) {
            return true;
        }

        return false;
    }

    /**
     * Get the result set from the DB
     * @method get
     * @author Matt Stephens <matthewstephens@digidev.co.uk>
     * @return array results
     */
    public function get()
    {
        if (empty($this->_where)) {
            $this->_dbConnection = $this->_dbConnection->prepare("SELECT * FROM $this->_table");
        }

        $this->_dbConnection->execute(empty($this->_where) ? [] : $this->_where);

        $results = $this->_dbConnection->fetchAll();

        return $results;
    }

}
