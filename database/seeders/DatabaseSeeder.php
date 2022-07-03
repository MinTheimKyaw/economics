<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Min Theim',
            'last_name' => 'Kyaw',
            'email' => 'mintheimkyaw@example.com',
            'password' => 'secret',
            'owner' => true,
        ]);
    }
}
