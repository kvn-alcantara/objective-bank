<?php

declare(strict_types=1);

namespace App\Infra\Database\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240619011914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Seed default payments';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO 
                payment_methods (name, acronym, tax) 
            VALUES 
                ('Pix', 'P', 0), ('Credit Card', 'C', 0.05), ('Debit Card', 'D', 0.03);
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM payment_methods WHERE acronym IN ('P', 'C', 'D')");
    }
}
