<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class CapabilitySeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            ['name' => 'create_post'],
            ['name' => 'edit_post'],
            ['name' => 'delete_post'],
            ['name' => 'view_post'],
            ['name' => 'create_user']
        ];

        $this->table('capability')
            ->insert($data)
            ->saveData();
    }
}
