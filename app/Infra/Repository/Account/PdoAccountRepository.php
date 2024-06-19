<?php

declare(strict_types=1);

namespace App\Infra\Repository\Account;

use PDO;

class PdoAccountRepository implements AccountRepositoryContract
{
    public function __construct(private PDO $db)
    {
    }

    /**
     * @throws \PDOException
     */
    public function create(array $data): int
    {
        $stmt = $this->db->prepare('INSERT INTO accounts (number, balance) VALUES (?, ?)');
        $stmt->execute([$data['numero_conta'], $data['saldo']]);

        return (int) $this->db->lastInsertId();
    }

    public function findByNumber(string $number): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM accounts WHERE number = ?');
        $stmt->execute([$number]);

        return $stmt->fetch() ?: null;
    }
}
