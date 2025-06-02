<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Nutrient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Expectation;
use function App\Helpers\upload_image;

class AdministratorFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Food::paginate(10);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json([
                "message" => "no food record"
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            "name" => ["required", "string"],
            "arabic_name" => ["required", "string"],
            "category_id" => ["required", 'exists:food_categories,id'],
            "image" => ["required", 'image'],
        ];


        $nutrients = $request['nutrients'];
        $required_nutrient_ids = Nutrient::where('is_required', 1)->pluck('id')->toArray();
        foreach ($nutrients as $id => $value) {
            $rules["nutrients.{$id}"] = 'exists:nutrients,id';
        }
        foreach ($required_nutrient_ids as $id) {
            $rules["nutrients.{$id}"] = 'required';
        }

        $data = $request->validate($rules);

        $file = $data['image'];
        /**
         * Dummy upload_image definition for IDE
         */
        $image_name = upload_image($file, Food::ORIGINAL_IMAGES_PATH, Food::SMALL_IMAGES_PATH);
        unset($data['image']);
        if ($image_name) {
            $data['image_name'] = $image_name;
        } else {
            return response()->json([
                'message' => "faild uploading image, for debuging AdministratorFoodController line:63",
            ], 500);
        }
        // inserting food data
        try {
            $food = Food::create($data);
            if ($food) {
                $pivotData = [];
                foreach ($nutrients as $id => $value) {
                    $pivotData[$id] = ['amount' => $value];
                }
                $food->nutrients()->attach($pivotData);
            }
            return response()->json([
                "message" => "data inserted successfuly",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "faild saving the data for debuging AdministratorFoodController line:80",
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($food_id): JsonResponse
    {
        $data = Food::where('id', $food_id)->first();
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(
                [
                    "errors" => [
                        'id' => 'can find food with this id'
                    ]
                ],
                404
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food): JsonResponse
    {
        $rules = [
            "name" => ["string"],
            "arabic_name" => ["string"],
            "category_id" => ['exists:food_categories,id'],
            "image" => ['image'],
        ];
        $nutrients = $request['nutrients'];
        foreach ($nutrients as $id => $value) {
            $rules["nutrients.{$id}"] = 'exists:nutrients,id';
        }

        $data = $request->validate($rules);

        if (array_key_exists('image', $data)) {
            $file = $data['image'];
            $image_name = "";//upload_image($file, Food::ORIGINAL_IMAGES_PATH, Food::SMALL_IMAGES_PATH);
            unset($data['image']);
            if (!$image_name) {
                return response()->json([
                    'errors' => [
                        'image' => "can't upload",
                    ]
                ], 422);
            } else {
                $data['image_name'] = $image_name;
            }

        }
        $updated = $food->update($data);
        try {
            if ($updated) {
                $pivotData = [];
                foreach ($nutrients as $id => $value) {
                    $pivotData[$id] = ['amount' => $value];
                }
                $food->nutrients()->attach($pivotData);
                return response()->json([
                    "message" => "data updated successfuly",
                ]);
            } else {
                return response()->json([
                    'errors' => [
                        'id' => "can find food with this id",
                    ],
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                "message" => "faild saving the data for debuging AdministratorFoodController line:80",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($food_id)
    {
        if (Food::where('id', $food_id)->delete()) {

        }

    }
}
