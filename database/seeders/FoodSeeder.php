<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = database_path('seeders/data/food.csv');
        if (!file_exists($file_path) || !is_readable($file_path)) {
            echo $file_path;
            return;
        }
        $file = file($file_path);

        $data = array_map('str_getcsv', $file);
        $header = array_shift($data);
        // print_r($header);
        // print_r($data[0]);
        // echo count($header) . '<br> \n';
        // echo count($data[0]);
        foreach ($data as $row) {
            if (count($row) != count($header)) {
                echo "error not all record have the same size found this : ";
                print_r($row);
                continue;
            }
            $row = array_combine($header, $row);
            Food::create([
                'id' => $row['id'],
                'name' => "'{$row['name']}'",
                'arabic_name' => "'{$row['arabic_name']}'",
                'category_id' => $row['category_id'],
                'image_name' => "no"
            ]);
        }
    }
}
