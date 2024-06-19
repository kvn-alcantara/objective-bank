<?php

declare(strict_types=1);

namespace App\Infra\Database;

use PDO;
use PDOException;

class Database
{
    private static $instance;

    /**
     * @throws PDOException
     */
    public static function getInstance(): PDO
    {
        if (is_null(self::$instance)) {
            try {
                self::$instance = new PDO(
                    'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'],
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASS'],
                    [
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int) $e->getCode());
            }
        }

        return self::$instance;
    }
}
