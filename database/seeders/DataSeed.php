<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Tax;
use App\Models\Warehouse;

class DataSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['name' => 'Electronics']);

        Category::create(['name' => 'Fan']);

        Unit::create(['name' => '1st Unit', 'code' => '0101', 'for' => 'Use', 'base_unit' => 'test', 'operator' => 'check', 'operation_value' => 'checking']);

        Tax::create(['name' => 'Tax One', 'rate' => 'five']);
        
        Warehouse::create(['name' => '1st Warehouse']);
    }
}
