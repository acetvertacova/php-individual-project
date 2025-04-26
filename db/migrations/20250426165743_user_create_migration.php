<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('user')
            ->addColumn('username', 'string', ['limit' => 50])
            ->addColumn('password', 'string', ['limit' => 255])
            ->create();
    }
}
