<?php

    
class DataBase {
    
    public $pdo;

    public $driver = 'mysql';
    public $host = 'localhost';
    public $dbname = 'mysql';
    public $charset = 'utf8';
    public $port = 3306;
    public $login = 'admin';
    public $pass = '123';
    public $option = [
        
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Error mod
        //PDO::ATTR_PERSISTENT => true // Infinite connect 

    ];

     // Autoload connect
    public function __construct() {

        /*try {
            $this->pdo = new PDO(

                $this->driver .
                ':host=' . $this->host .
                ';dbname=' . $this->dbname .
                ';charset=' . $this->charset .
                ';port=' . $this->port,
                $this->login,
                $this->pass,
                $this->option

            );
        } catch(PDOException $e) {
            exit($e->getMessage());
        }*/
    }

     // Connect to external database
    public function ConnectDataBase($login, $pass) {

        $this->login = $login;
        $this->pass = $pass;

        try {
            $this->pdo = new PDO(

                $this->driver .
                ':host=' . $this->host .
                ';dbname=' . $this->dbname .
                ';charset=' . $this->charset .
                ';port=' . $this->port,
                $this->login,
                $this->pass,
                $this->option

            );
        } catch(PDOException $e) {
            //exit($e->getMessage());
            return $this->pdo;
        }
    }

// Users
     // Create User
    public function createUser($name, $pass) {

        $sql = "GRANT ALL ON *.* TO '$name'@'localhost' = PASSWORD('$pass');";
        $result = $this->pdo->exec($sql);
    }

     // Redact Password
    public function setPassword($name, $pass) {

        $sql = "SET PASSWORD FOR '$name'@'localhost' = PASSWORD('$pass');";
        $result = $this->pdo->exec($sql);
    }
// Databases
     // Create Database
    public function createDatabase($name) {

        $sql = "CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $result = $this->pdo->exec($sql);    
    }

     // Show Database
    public function showDatabase() {

        $sql = "SHOW DATABASES;";
        $result = $this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

     // Delete Database
    public function deleteDatabase($name) {

        $sql = "DROP DATABASE IF EXISTS $name;";
        $result = $this->pdo->exec($sql);
    }
// Tables
     // Create Table
    public function createTable($name) {

        $sql = "CREATE TABLE IF NOT EXISTS $name (id INT UNSIGNED NOT NULL AUTO_INCREMENT, PRIMARY KEY(id));";
        $result = $this->pdo->exec($sql);
    }

     // Show Table
    public function showTable($db) {

        $sql = "USE $db;SHOW TABLES;";
        $result = $this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

     // Rename Table
    public function renameTable($name, $newname) {

        $sql = "ALTER TABLE $name RENAME $newname;";
        $result = $this->pdo->exec($sql);
    }

      // Delete Table 
          public function deleteTable($name) {

        $sql = "DROP TABLE IF EXISTS $name;";
        $result = $this->pdo->exec($sql);
    }
// Columns
     // Add column
    public function addColumn($table, $name, $type) {

        $sql = "ALTER TABLE $table ADD $name $type NOT NULL;";
        $result = $this->pdo->exec($sql);
    }

     // Delete column
    public function deleteColumn($table, $name) {

        $sql = "ALTER TABLE $table DROP $name;";
        $result = $this->pdo->exec($sql);
    }

// Rows
     // Add line
     public function addRow($table, $where, $row) {

        $sql = "INSERT INTO $table($where) VALUES($row);";
        $result = $this->pdo->exec($sql);
     }

}