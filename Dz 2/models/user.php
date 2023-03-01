<?php
class User {
    private ?PDO $connect;
    private string $table_name = "user";
    public int $id;
    public string $username;
    public string $name;
    public string $city_name;
    public int $city_id; 

    public function __construct($db) 
    {
        $this->connect = $db;
    }

    public function get(): bool|PDOStatement 
    {
        $query = "SELECT user.id, user.name, user.username, city.name as city_name FROM " . $this->table_name . "  LEFT JOIN city ON user.city_id = city.id ORDER BY  user.id DESC";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    public function create(): bool 
    {
        $query = "INSERT INTO "  . $this->table_name . " SET name =: name, username =: username, city_id =: city_id";
        $stmt = $this->connect->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));
        $this->username = htmlspecialchars(strip_tags($this->username));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":city_id", $this->city_id);
        $stmt->bindParam(":username", $this->username);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete(): bool 
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->connect->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update(): bool 
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name, username = :username, city_id = :city_id WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":city_id", $this->city_id);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}