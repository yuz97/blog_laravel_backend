<?php

namespace Database\Seeders;

use App\Models\Posts\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::insert([
            [
                'title' => 'Laravel',
                'slug' => 'laravel',
                'color' => 'red',
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ],
            [
                'title' => 'Django',
                'slug' => 'django',
                'color' => 'green',
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ],
            [
                'title' => 'Codeigniter',
                'slug' => 'codeigniter',
                'color' => 'orange',
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ],
        ]);
    }
}
