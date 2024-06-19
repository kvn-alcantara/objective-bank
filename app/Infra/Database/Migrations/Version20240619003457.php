<?php

declare(strict_types=1);

namespace Infra\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240619003457 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('payment_methods');

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('acronym', 'string', ['length' => 1]);
        $table->addColumn('tax', 'decimal', ['precision' => 10, 'scale' => 2, 'default' => 0]);
        $table->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['acronym']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('payment_methods');
    }
}
