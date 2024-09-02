<?php

use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;

return new class {
    private string $table = 'products';

    public function up(AbstractSchemaManager $schemaManager, Schema $schema): void
    {
        if (!$schemaManager->tablesExist($this->table)) {
            $table = $schema->createTable($this->table);
            $table->addColumn('id', Types::INTEGER, [
                'autoincrement' => true,
                'unsigned' => true,
            ]);
            $table->addColumn('name', Types::STRING);
            $table->addColumn('description', Types::STRING);
            $table->addColumn('category', Types::STRING);
            $table->addColumn('price', Types::FLOAT);
            $table->addColumn('discount', Types::FLOAT);
            $table->addColumn('rating', Types::FLOAT);
            $table->addColumn('stock', Types::INTEGER);
            $table->addColumn('brand', Types::STRING);
            $table->addColumn('sku', Types::STRING);
            $table->addColumn('thumbnail', Types::STRING);
            $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, [
                'default' => 'CURRENT_TIMESTAMP',
            ]);
            $table->setPrimaryKey(['id']);
            echo "Table $this->table created" . PHP_EOL;
        } else {
            echo "Table $this->table exist" . PHP_EOL;
        }
    }

    public function down(AbstractSchemaManager $schemaManager, Schema $schema): void
    {
        if ($schemaManager->tablesExist($this->table)) {
            $schemaManager->dropTable($this->table);
            echo "Table $this->table delete" . PHP_EOL;
        } else {
            echo "Table $this->table not found" . PHP_EOL;
        }
    }
};