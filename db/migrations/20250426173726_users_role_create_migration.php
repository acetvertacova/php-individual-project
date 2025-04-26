<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsersRoleCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('users_role')
            ->addColumn('user_id', 'integer')
            ->addColumn('role_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'SET_NULL'])
            ->addForeignKey('role_id', 'role', 'id', ['delete' => 'SET_NULL'])
            ->create();
    }
}
