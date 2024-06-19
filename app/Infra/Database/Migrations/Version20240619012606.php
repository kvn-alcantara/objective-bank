<?php

declare(strict_types=1);

namespace Infra\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240619012606 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('accounts');

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('balance', 'decimal', ['precision' => 10, 'scale' => 2]);
        $table->addColumn('number', 'string', ['length' => 255]);
        $table->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);

        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('accounts');
    }
}
