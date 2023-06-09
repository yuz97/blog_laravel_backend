<?php

namespace Database\Seeders;

use App\Models\Posts\Post;
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
        // User::factory(10)->create();
        $this->call([
            SubjectSeeder::class,
        ]);
    }
}
