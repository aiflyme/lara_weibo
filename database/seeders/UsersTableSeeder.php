<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(50)->create();

        $user = User::find(1);
        $user->name = 'aiflyme0';
        $user->email = 'aiflyme@qq.com';
        $user->is_admin = true;
        $user->save();

        $user1 = User::find(2);
        $user1->name = 'aiflyme1';
        $user1->email = 'aiflyme@gmail.com';
        $user1->save();

    }
}
