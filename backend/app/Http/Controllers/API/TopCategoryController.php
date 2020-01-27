<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TopCategory;
use phpDocumentor\Reflection\Types\Boolean;

class TopCategoryController extends Controller
{
    public function all() {
        $categories = TopCategory::all();
        return response()->json(['data' => [
            'statusCode' => '200',
            'category' => $categories,
        ]]);
    }



    public function view($id) {
        $category = TopCategory::find($id);

        if ($category) {
            if ($category->has_page) {
                return response()->json(['data' => [
                    'statusCode' => 200,
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
            'title' => 'required|min:2|max:100',
            'description' => 'required|min:20',
            'thumbnail' => 'required|image',
            'has_page' => 'required',
            'is_private' => 'required',
            'show_in_navigation' => 'required',
            'show_in_footer' => 'required'
        ]);

        if ($validator) {
            $category = new TopCategory;
            $category->title = $request->title;
            $category->description = $request->description;
            $category->has_page = $request->has_page;
            $category->is_private = $request->is_private;
            $category->show_in_footer = $request->show_in_footer;
            $category->show_in_navigation = $request->show_in_navigation;

            //Upload image
            $image = $request->file('thumbnail');
            $destinationPath = 'public/thumbnail/topCategory';

            if ($image->storeAs("$destinationPath", $image)) {
                $category->thumbnail = basename($image . '.' .$image->getClientOriginalExtension());
            } else {
                return response()->json([
                    'errors' => [
                        'root' => 'The image cannot be uploaded.'
                    ]
                ]);
            }

            $category->save();

            return response()->json([
                'data' => $category,
            ], 200);
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
