<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Meal;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientEdibleLogController extends Controller
{
    public function addEdibleLog(Request $request)
    {
        $data = $request->validate([
            'food_id' => ["required_without:meal_id", "prohibited_with:meal_id", 'exists:foods,id'],
            'meal_id' => ["required_without:food_id", "prohibited_with:food_id", 'exists:meals,id'],
            'quantity' => ['required', 'numeric'],
        ]);
        /** @var \App\Models\Patient $patient */
        $patient = Auth::guard(Patient::GUARD_NAME)->user();
        if ($data['food_id']) {
            $patient->food_logs()->attach($data['food_id'], ['quantity' => $data['quantity']]);
        } else {
            $patient->meal_logs()->attach($data['meal_id'], ['quantity' => $data['quantity']]);
        }
    }

    public function findSomthingToEat(Request $request)
    {
        $data = $request->validate([
            'search_term' => ["string", 'required'],
        ]);
        $foods = Food::where('name', 'LIKE', "%{$data['search_term']}%")
            ->orWhere('arabic_name', 'LIKE', "%{$data['search_term']}%")
            ->get()->sortBy(function ($food) {
                return str_word_count($food->name);
            });

        $meals = Meal::where('name', 'LIKE', "%{$data['search_term']}%")
            ->orWhere('arabic_name', 'LIKE', "%{$data['search_term']}%")->get();
        $res = [];
        foreach ($foods as $food) {
            $res[$food->id] = sizeof(preg_split('/\s+/', $food->name));
        }
        foreach ($meals as $meal) {
            $res[$meal->id] = sizeof(preg_split('/\s+/', $meal->name));
        }
        return response()->json([
            "foods" => $foods,
            "meals" => $meals,
        ]);
    }
}
