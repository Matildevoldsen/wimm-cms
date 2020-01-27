<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopCategoryRequest;
use App\Http\Requests\UpdateTopCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller {
    public function all(/*$sort = 'DEFAULT', $where = null, $whereOperator = null, $whereValue = null*/) {
        $categories = Category::all();
        return response()->json( ['data' => [
            'statusCode' => '200',
            'category' => $categories,
        ]] );
    }

    public function view($id) {
        $category = Category::find( $id );

        if ( $category ) {
            if ( $category->has_page ) {
                return response()->json( ['data' => [
                    'statusCode' => 200,
                    'category' => $category,
                    'readable_dates' => [
                        'updated_at' => $category->updated_at->diffForHumans(),
                        'created_at' => $category->created_at->diffForHumans(),
                    ]
                ]] );
            } else {
                return response()->json( [
                    'errors' => [
                        'root' => 'This top category does not have a visble page'
                    ]
                ] );
            }
        } else {
            return response()->json( [
                'errors' => [
                    'root' => 'This top category does not exist'
                ]
            ] );
        }
    }

    public function store( StoreTopCategoryRequest $request ) {
        $validated = $request->validated();
        if ( $validated ) {
            $category = new Category;
            $category->title = $request->title;
            $category->description = $request->description;
            $category->thumbnail_alt = $request->thumbnail_alt;
            $category->lang = $request->lang;
            $category->seo_desc = $request->seo_desc;
            $category->top_category_id = $request->top_category_id;
            $category->is_private = $request->is_private;
            $category->show_in_footer = $request->show_in_footer;
            $category->show_in_navigation = $request->show_in_navigation;

            //Upload image
            $image = $request->file( 'thumbnail' );
            $destinationPath = 'public/thumbnail/topCategory';

            if ( $image->storeAs( "$destinationPath", $image ) ) {
                $category->thumbnail = basename( $image . '.' .$image->getClientOriginalExtension() );
            }

            $category->save();

            return response()->json( [
                'data' => $category,
            ], 200 );
        }
    }

    public function update (UpdateTopCategoryRequest $request, $id) {
        $validated = $request->validated();
        if ( $validated ) {
            $category = Category::find($id);
            $category->title = $request->title;
            $category->description = $request->description;
            $category->thumbnail_alt = $request->thumbnail_alt;
            $category->lang = $request->lang;
            $category->seo_desc = $request->seo_desc;
            $category->top_category_id = $request->top_category_id;
            $category->is_private = $request->is_private;
            $category->show_in_footer = $request->show_in_footer;
            $category->show_in_navigation = $request->show_in_navigation;

            //Upload image
            if ($request->hasFile('thumbnail')) {
                $image = $request->file( 'thumbnail' );
                $destinationPath = 'public/thumbnail/topCategory';

                Storage::delete($destinationPath . $category->thumbnail);

                if ( $image->storeAs( "$destinationPath", $image ) ) {
                    $category->thumbnail = basename( $image . '.' .$image->getClientOriginalExtension() );
                }
            }

            $category->save();

            return response()->json( [
                'data' => $category,
            ], 200 );
        }
    }

    public function delete($id) {
        
    }
}