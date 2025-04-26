<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PermissionCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('permission')
            ->addColumn('role_id', 'integer')
            ->addColumn('capability_id', 'integer')
            ->addForeignKey('role_id', 'role', 'id', ['delete' => 'SET_NULL'])
            ->addForeignKey('capability_id', 'capability', 'id', ['delete' => 'SET_NULL'])
            ->create();
    }
}
