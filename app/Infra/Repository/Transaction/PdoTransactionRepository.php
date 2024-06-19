<?php

declare(strict_types=1);

namespace App\Infra\Repository\Transaction;

use PDO;

class PdoTransactionRepository implements TransactionRepositoryContract
{
    public function __construct(private PDO $db)
    {
    }

    /**
     * @throws \PDOException
     */
    public function create(array $data): int
    {
        $stmt = $this->db->prepare('
            INSERT INTO 
                transactions (payment_method_acronym, payment_method_tax, account_id, amount, balance) 
            VALUES (?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $data['payment_method_acronym'],
            $data['payment_method_tax'],
            $data['account_id'],
            $data['amount'],
            $data['balance']
        ]);

        return (int) $this->db->lastInsertId();
    }
}
