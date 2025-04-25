<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BookCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('book')
            ->addColumn('title', 'string', ['limit' => 100])
            ->addColumn('author', 'string', ['limit' => 100])
            ->addColumn('genre', 'string', ['limit' => 100])
            ->addColumn('available', 'boolean', ['default' => true])
            ->addColumn('description', 'text')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
