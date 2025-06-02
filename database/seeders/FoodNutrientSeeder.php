<?php

namespace Database\Seeders;

use App\Models\FoodNutrient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

class FoodNutrientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = database_path('seeders/data/food_nutrient.csv');
        if (!file_exists($file_path) || !is_readable($file_path)) {
            echo "can't read this file : " . $file_path;
        }

        $file = file($file_path);
        $data = array_map('str_getcsv', $file);
        $header = array_shift($data);
        $appear = false;
        foreach ($data as $row) {
            if (count($header) != count($row)) {
                echo "not all record have the same length, found this :  ";
                print_r($row);
            }
            $row = array_combine($header, $row);
            if (!$appear) {
                if ($row['id'] == 8525376) {
                    $appear = true;
                }else{
                    continue;
                }
            }
            $data = [
                'food_id' => $row['food_id'],
                'nutrient_id' => $row['nutrient_id'],
                'amount' => $row['amount'],
            ];
            if (!empty($row['min'])) {
                $data['min'] = $row['min'];
            }
            if (!empty($row['max'])) {
                $data['max'] = $row['max'];
            }
            if (!empty($row['median'])) {
                $data['median'] = $row['median'];
            }
            FoodNutrient::create(
                $data
            );
        }
    }
}
