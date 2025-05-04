<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class PermissionSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            ['role_id' => 1, 'capability_id' => 4],
            ['role_id' => 2, 'capability_id' => 1],
            ['role_id' => 2, 'capability_id' => 2],
            ['role_id' => 2, 'capability_id' => 3],
            ['role_id' => 2, 'capability_id' => 4],
            ['role_id' => 2, 'capability_id' => 5]
        ];

        $this->table('permission')
            ->insert($data)
            ->saveData();
    }
}
