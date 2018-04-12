<?php

// CONNECTION

class connection
{
    public static function make($config)
    {
        try {
            return new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOEXCEPTION $e) {
            die($e->getMessage());
        }
    }
}

// QUERY BUILDER

class Query
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from $table");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function count($table)
    {
        $statement = $this->pdo->prepare("select count(*) from $table");
        $statement->execute();
        return $statement->fetchColumn();
    }
    public function select($data, $table, $column, $value)
    {
        $sql = "SELECT $data FROM $table WHERE $column = ?";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$value]);
            return $statement->fetchAll();
        } catch (Exception $e) {
            warning('Failed to retrieve data, please report this to the administrator.');
        }
    }
    public function selectTwo($data, $table, $column1, $column2, $value1, $value2)
    {
        $sql = "SELECT $data FROM $table WHERE $column1 = ? AND $column2 = ?";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$value1, $value2]);
            return $statement->fetchAll();
        } catch (Exception $e) {
            warning('Failed to retrieve data, please report this to the administrator.');
        }
    }
    public function between($data, $table, $column, $value1, $value2)
    {
        $sql = "SELECT $data FROM $table WHERE $column BETWEEN ? AND ?";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$value1, $value2]);
            return $statement->fetchAll();
        } catch (Exception $e) {
            warning('Failed to retrieve data, please report this to the administrator.');
        }
    }
    public function insert($table, $param)
    {
        $sql = sprintf(
        'INSERT INTO %s (%s) VALUES (%s);',
        $table,
        implode(',', array_keys($param)),
        ':'.implode(',:', array_keys($param))
      );
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($param);
        } catch (Exception $e) {
            warning('Failed to send data, please report this to the administrator.');
        }
    }
    public function update($table, $column, $info, $value1, $value2)
    {
        $sql = "UPDATE $table SET $column = ? WHERE $value1 = ?";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$info, $value2]);
        } catch (PDO $e) {
            warning('Failed to update data, please report this to the administrator.');
        }
    }
    public function reset()
    {
        $sql1 = "ALTER TABLE $table DROP $column";
        $sql2 = "ALTER TABLE $table ADD $newColumn";
        try {
            $statement = $this->pdo->prepare($sql1);
            $statement->execute();
            $statement = $this->pdo->prepare($sql2);
            $statement->execute();
        } catch (PDO $e) {
            warning('Failed to update data, please report this to the administrator.');
        }
    }
}
