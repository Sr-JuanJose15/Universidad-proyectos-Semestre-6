<?php

namespace Database\Seeders;

use Illuminate\Container\Attributes\DB as AttributesDB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('products')->insert([
        'code' => str::random(4),
        'name' => str::random(20),
        'unit' => str::random(3),
        'amount' => str::random(0,1000),

      ]);
    }
}
