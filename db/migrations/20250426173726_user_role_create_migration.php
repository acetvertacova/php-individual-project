<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserRoleCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('user_role')
            ->addColumn('user_id', 'integer')
            ->addColumn('role_id', 'integer')
            ->addForeignKey('user_id', 'user', 'id', ['delete' => 'SET_NULL'])
            ->addForeignKey('role_id', 'role', 'id', ['delete' => 'SET_NULL'])
            ->create();
    }
}
