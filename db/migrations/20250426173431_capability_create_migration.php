<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CapabilityCreateMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('capability')
            ->addColumn('name', 'string')
            ->create();
    }
}
