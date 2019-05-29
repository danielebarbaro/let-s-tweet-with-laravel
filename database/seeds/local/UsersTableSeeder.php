<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(['username' => 'daniele']);
        foreach (range(1, 50) as $element) {
            factory(User::class)->create();
        }
    }
}
