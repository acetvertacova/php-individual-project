<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UsersSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'username' => 'john.doe',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
            ],
            [
                'username' => 'jane.smith',
                'password' => password_hash('76542edgw', PASSWORD_DEFAULT),
            ]
        ];

        $this->table('users')
            ->insert($data)
            ->saveData();
    }
}
