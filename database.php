<?php
class Database
{
    public $db;
    public $servername_db;
    public $username_db;
    public $password_db;
    public $database_db;
    public function getConnection()
    {

        $this->servername_db = "localhost";
        $this->username_db = "root";
        $this->password_db = "";
        $this->database_db = "apicruddb";
        $this->db = null;
        try {
            $this->db = new PDO("mysql:host=$this->servername_db;dbname=$this->database_db", $this->username_db, $this->password_db);

        } catch (Exception $e) {
            echo "Database could not be connected: " . $e->getMessage();
        }
        return $this->db;
    }
}
