<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**


     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name' => 'asummi',
                'email' => 'asumi@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'atsumori',
                'email' => 'atsumori@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'okada',
                'email' => 'okada@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'ryohei',
                'email' => 'ryohei@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'taitoh',
                'email' => 'taitoh@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'pochi',
                'email' => 'pochi@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'naomi',
                'email' => 'naomi@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'kazue',
                'email' => 'kazue@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'emiko',
                'email' => 'emiko@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'itsuki',
                'email' => 'itsuki@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],
            [
                'name' => 'nakashi',
                'email' => 'nakashi@gmail.com',
                'password' => Hash::make('asdfasdf'),
                'role_id' => User::USER_ROLE_ID,
            ],

        ];

        $this->user->insert($users);
    }
}
