<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create(['name' => 'Admin', 'email' => 'admin@admin.com']);
        User::factory(10)->create();
        Contact::factory(100)->has(Phone::factory(random_int(0, 3)))->create();
    }
}
