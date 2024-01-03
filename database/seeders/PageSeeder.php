<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('pages')->insert([
            'name' => 'Popup index',
            'url' => '/popups',
            
        ]);
        DB::table('pages')->insert([
            'name' => 'Popup create',
            'url' => '/popups/create',
            
        ]);
    }
}
