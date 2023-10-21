<?php

declare(strict_types=1);

namespace app\database;

abstract class Provider {

    protected static ?\PDO $link = null;

    public function connect() : \PDO {
        if(self::$link == null) {
            $host = $_ENV['DB_HOST'];
            $user = $_ENV['DB_USER'];
            $port = $_ENV['DB_PORT'];
            $password = $_ENV['DB_PASSWORD'];
            $database = $_ENV['DB_DATABASE'];

            self::$link = new \PDO("mysql:host=$host;dbname=$database;port=$port;charset=utf8mb4;", $user, $password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);

            $resource = fopen(__DIR__ . "/../../deploy.sql", "r");
            //var_dump($resource);
            self::$link->exec(stream_get_contents($resource));
            fclose($resource);
        }
        return self::$link;
    }

    public function close() : void {
        self::$link = null;
    }

    public function __wakeup()
    {
        $this->connect();
    }
}
?>