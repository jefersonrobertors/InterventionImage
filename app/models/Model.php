<?php

declare(strict_types=1);

namespace app\models;

use app\database\Provider;

abstract class Model extends Provider {

    protected string $table;

    public function find(string $field, mixed $value)
    {
        $connection = $this->connect();
        $prepare = $connection->prepare("select * from {$this->table} where {$field} = :{$field}");
        $prepare->execute([$field => $value]);

        return $prepare->fetchObject(static::class);
    }

    public function login($email, $password) {
        $connection = $this->connect();
        $prepare = $connection->prepare("select * from {$this->table} where email = :email AND password = :password;");
        $prepare->execute(['email' => $email, 'password' => $password]);

        if($prepare->rowCount() <= 0) return false;
        return $prepare->fetchObject(static::class);
    }

    public function update(array $attributes, array $where) {
        try {
            $sql = "update {$this->table} set ";
            foreach (array_keys($attributes) as $key) {
                $sql .= "{$key} = :{$key},";
            }
            $sql = rtrim($sql, ',');
            $sql .= ' where id = :id';
            $prepare = $this->connect()->prepare($sql);

            return $prepare->execute([
                ...$attributes, ...$where,
            ]);
        }catch (\PDOException $e) {
            echo $e->getMessage();
        }finally{
            $this->close();
        }
    }
}
?>