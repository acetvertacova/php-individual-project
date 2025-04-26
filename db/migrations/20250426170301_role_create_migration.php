<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RoleCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('role')
            ->addColumn('name', 'string')
            ->create();
    }
}
