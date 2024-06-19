<?php

declare(strict_types=1);

namespace App\Infra\Repository\PaymentMethod;

use PDO;

class PdoPaymentMethodRepository implements PaymentMethodRepositoryContract
{
    public function __construct(private PDO $db)
    {
    }

    public function findByAcronym(string $acronym): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM payment_methods WHERE acronym = ?');
        $stmt->execute([$acronym]);

        return $stmt->fetch() ?: null;
    }
}
