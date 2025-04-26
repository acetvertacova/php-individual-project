<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsersCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('users')
            ->addColumn('username', 'string', ['limit' => 50])
            ->addColumn('password', 'string', ['limit' => 255])
            ->create();
    }
}
