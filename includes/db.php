<?php
require_once 'config.php';

class Database {
    private $conn;
    
    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            die();
        }
    }
    
    public function getConnection() {
        return $this->conn;
    }
}
?>