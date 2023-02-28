<?php
    require 'vendor/autoload.php';
    class Database{
        private string $host;
        private string $db_name;
        private string $username;
        private string $password;
        public ?PDO $connect;

        public function getConnection(): ?PDO 
        {
            $dotenv = Dotenv\Dotenv::createImmutable('../');
            $dotenv->load();

            $this->db_name = $_ENV['DATABASE_NAME'];
            $this->host = $_ENV['DATABASE_HOST'];
            $this->username = $_ENV['DATABASE_USER'];
            $this->password = $_ENV['DATABASE_PASSWORD'];
            $this->connect = null;

            try {
                $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->connect->exec("set names utf8");
            } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->connect;
        }
    }