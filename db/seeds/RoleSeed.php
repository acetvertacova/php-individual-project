<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class RoleSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            ['name' => 'user'],
            ['name' => 'admin']
        ];

        $this->table('role')
            ->insert($data)
            ->saveData();
    }
}
