<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UsersRoleSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            ['user_id' => 1, 'role_id' => 1],
            ['user_id' => 2, 'role_id' => 2]
        ];

        $this->table('users_role')
            ->insert($data)
            ->saveData();
    }
}
