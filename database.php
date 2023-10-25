<?php
class Database
{
    public $db;
    public function getConnection()
    {
        $this->db = null;
        try {
            $this->db = new mysqli('your_db_host', 'your_db_username', 'your_db_password', 'you_db_name');
        } catch (Exception $e) {
            echo "Database could not be connected: " . $e->getMessage();
        }
        return $this->db;
    }
}
