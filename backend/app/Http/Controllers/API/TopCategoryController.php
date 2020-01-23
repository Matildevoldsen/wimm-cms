<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TopCategory;

class TopCategoryController extends Controller
{
    public function all() {
        return TopCategory::all();
    }

    public function view($id) {
        $category = TopCategory::find($id);

        if ($category) {
            if ($category->has_page) {
                return response()->json(['data' => [
                    'statusCode' => '200',
                    'category' => $category,
                    'readable_dates' => [
                        'updated_at' => $category->updated_at->diffForHumans(),
                        'created_at' => $category->created_at->diffForHumans(),
                    ]
                ]]);
            } else {
                return response()->json([
                    'errors' => [
                        'root' => 'This top category does not have a visble page'
                    ]
                ]);
            }
        } else {
            return response()->json([
                'errors' => [
                    'root' => 'This top category does not exist'
                ]
            ]);
        }
    }

    public function store(Request $request) {
        $validator = $request->validate([
            'title' => 'required|min:2',
            'description' => 'required|min:20',
            'thumbnail' => 'required|image'
        ]);

        if ($validator) {
            //Finish create function
        } else {
            return response([
                'errors' => [
                    'root' => [$validator]
                ]
            ], 422);
        }
    }

    public function update(Request $request) {

    }

    public function delete(Request $request) {

    }
}
