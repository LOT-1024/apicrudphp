<?php
class Database
{
    public $db;
    public function getConnection()
    {
        $this->db = null;
        try {
            $this->db = new mysqli('your_hostname', 'your_username', 'your_password', 'your_dbname');
        } catch (Exception $e) {
            echo "Database could not be connected: " . $e->getMessage();
        }
        return $this->db;
    }
}
