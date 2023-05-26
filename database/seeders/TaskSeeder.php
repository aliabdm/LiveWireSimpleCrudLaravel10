<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
       for ($i=4; $i >0 ; $i--) {
        $task = new Task();
        $task->name = $faker->name;
        $task->priority = $i;
        $task->save();
       }
    }
}
