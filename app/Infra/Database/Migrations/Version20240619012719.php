<?php

declare(strict_types=1);

namespace Infra\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240619012719 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('transactions');

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('account_id', 'integer', ['notnull' => true]);
        $table->addColumn('amount', 'decimal', ['precision' => 10, 'scale' => 2, 'notnull' => true]);
        $table->addColumn('payment_method_acronym', 'string', ['length' => 1, 'notnull' => true]);
        $table->addColumn('payment_method_tax', 'decimal', ['precision' => 10, 'scale' => 2, 'notnull' => true]);
        $table->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'notnull' => true]);

        $table->setPrimaryKey(['id']);
        $table->addForeignKeyConstraint('accounts', ['account_id'], ['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('transactions');
    }
}
