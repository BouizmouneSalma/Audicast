<?php
namespace App\Core;

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = require __DIR__ . '/../config/database.php';
        
        try {
            $dsn = sprintf(
                "pgsql:host=%s;port=%s;dbname=%s;user=%s;password=%s",
                $config['host'],
                $config['port'],
                $config['database'],
                $config['username'],
                $config['password']
            );

            $this->connection = new \PDO($dsn);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
            // Définir le schéma par défaut
            $this->connection->exec("SET search_path TO {$config['schema']}");
        } catch (\PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur de requête : " . $e->getMessage());
        }
    }
}