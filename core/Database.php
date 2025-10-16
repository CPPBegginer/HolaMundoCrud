<?php
// core/Database.php

class Database {

  private static ?PDO $instance = null;

  public static function getConnection(): PDO {

    if (self::$instance === null) {

      $dsn = 'mysql:host=' . DB_HOST . ';port=3315;dbname=' . DB_NAME . ';charset=utf8mb4';

      $opts = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
      ];

      try {
        self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opts);
      } catch (PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
      }
    }

    return self::$instance;
  }
}
