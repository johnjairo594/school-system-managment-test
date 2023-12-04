<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Subject::create(['name' => 'Math', 'description' => 'ri-add-box-fill']);
        Subject::create(['name' => 'Spanish', 'description' => 'ri-global-line']);
        Subject::create(['name' => 'Science', 'description' => 'ri-plant-line']);
        Subject::create(['name' => 'Biology', 'description' => 'ri-flower-line']);
    }
}
