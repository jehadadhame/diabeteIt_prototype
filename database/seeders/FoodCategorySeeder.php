<?php

namespace Database\Seeders;

use App\Models\FoodCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = database_path('seeders\\data\\category.csv');
        if (!file_exists($file_path) || !is_readable($file_path)) {
            echo $file_path;
            return;
        }
        $file = file($file_path);

        $data = array_map('str_getcsv', $file);
        $header = array_shift($data);
        foreach ($data as $row) {

            $row = array_combine($header, $row);

            FoodCategory::create([
                'id' => $row['id'],
                'name' => $row['name'],
                'arabic_name' => $row['arabic_name'],
            ]);
        }
    }
}
