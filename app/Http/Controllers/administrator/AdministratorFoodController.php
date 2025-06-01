<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function App\Helpers\upload_image;
use function Laravel\Prompts\error;

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

        // $data = $request->validate([
        //     "name" => ["required", "string"],
        //     "calories" => ["required", "numeric"],
        //     "carbs_grams" => ["required", "numeric"],
        //     "fiber_grams" => ["required", "numeric"],
        //     "protein_grams" => ["required", "numeric"],
        //     "fat_grams" => ["required", "numeric"],
        //     "net_carbs" => ["required", "numeric"],
        //     "glycemic_index" => ["required", "integer"],
        //     "glycemic_load" => ["required", "numeric"],
        //     "unit" => ["required", "in:ml,grams"],
        //     "image" => ["required", 'image'],
        // ]);

        // $file = $data['image'];
        // $image_name = upload_image($file, Food::ORIGINAL_IMAGES_PATH, Food::SMALL_IMAGES_PATH);
        // $data['image_name'] = $image_name;
        // unset($data['image']);

        // if ($image_name) {
        //     if (Food::create($data)) {
        //         return response()->json([
        //             "message" => "data inserted successfuly",
        //         ]);
        //     }

        // }
        // return response()->json([
        //     'message' => "faild",
        // ]);
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
    public function update(Request $request, $food_id): JsonResponse
    {
        $data = $request->validate([
            "name" => ["string"],
            "calories" => ["numeric"],
            "carbs_grams" => ["numeric"],
            "fiber_grams" => ["numeric"],
            "protein_grams" => ["numeric"],
            "fat_grams" => ["numeric"],
            "net_carbs" => ["numeric"],
            "glycemic_index" => ["integer"],
            "glycemic_load" => ["numeric"],
            "unit" => ["in:ml,grams"],
            "image" => ['image'],
        ]);
        if (array_key_exists('image', $data)) {
            $file = $data['image'];
            $image_name = "";//upload_image($file, Food::ORIGINAL_IMAGES_PATH, Food::SMALL_IMAGES_PATH);
            $data['image_name'] = $image_name;
            unset($data['image']);
            if (!$image_name) {
                return response()->json([
                    'errors' => [
                        'image' => "can't upload",
                    ]
                ], 422);
            }

        }

        if (Food::where('id', $food_id)->update($data)) {
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
