<?php

class DB {
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            $host = getenv("DB_HOST");
            $port = getenv("DB_PORT");
            $db   = getenv("DB_NAME");
            $user = getenv("DB_USER");
            $pass = getenv("DB_PASSWORD");

            try {
                self::$conn = new PDO(
                    "pgsql:host=$host;port=$port;dbname=$db",
                    $user,
                    $pass
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["error" => "Database connection failed"]);
                exit;
            }
        }

        return self::$conn;
    }
}