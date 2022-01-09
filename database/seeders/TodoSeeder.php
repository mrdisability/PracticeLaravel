<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Todo::create(['todo' => 'First Todo', 'completed' => false]);
        \App\Models\Todo::create(['todo' => 'Second Todo', 'completed' => false]);
        \App\Models\Todo::create(['todo' => 'Third Todo', 'completed' => false]);
    }
}
