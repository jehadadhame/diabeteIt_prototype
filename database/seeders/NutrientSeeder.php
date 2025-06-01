<?php

namespace Database\Seeders;

use App\Models\Nutrient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NutrientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = database_path('seeders/data/nutrient.csv');
        if (!file_exists($file_path) || !is_readable($file_path)) {
            echo "can't read this file : " . $file_path;
        }

        $file = file($file_path);
        $data = array_map('str_getcsv', $file);
        $header = array_shift($data);
        foreach ($data as $row) {
            if (count($header) != count($row)) {
                echo "not all record have the same length, found this :  ";
                print_r($row);
            }
            $row = array_combine($header, $row);
            Nutrient::create(
                [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'arabic_name' => $row['arabic_name'],
                    'unit_name' => $row['unit_name'],
                    'type' => $row['type'],
                    'is_required' => $row['is_required'],
                ]
            );
        }
    }
}
