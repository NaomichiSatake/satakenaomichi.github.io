<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class AdminSeeder extends Seeder
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
        $this->user->name = "Administrator";
        $this->user->email = "admin@gmail.com";
        $this->user->password = Hash::make('asdfasdf');
        $this->user->role_id = User::ADMIN_ROLE_ID; //1
        $this->user->save();
    }
}
