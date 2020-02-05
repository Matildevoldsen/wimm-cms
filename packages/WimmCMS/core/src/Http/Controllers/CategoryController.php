<?php

namespace WimmCMS\core\Http\Controllers;

use WimmCMS\core\Http\Requests\StoreCategoryRequest;
use WimmCMS\core\Http\Requests\UpdateTopCategoryRequest;
use Illuminate\Support\Facades\Storage;
use WimmCMS\core\Models\Category;

class CategoryController extends Controller {
    public function all( /*$sort = 'DEFAULT', $where = null, $whereOperator = null, $whereValue = null*/ ) {
        $categories = Category::all();
        return response()->json( ['data' => [
            'statusCode' => '200',
            'category' => $categories,
        ]] );
    }

    public function view( $id ) {
        $category = Category::find( $id );

        if ( $category ) {
            return response()->json( ['data' => [
                'statusCode' => 200,
                'category' => $category,
            ]] );
        } else {
            return response()->json( [
                'errors' => [
                    'root' => 'This top category does not exist'
                ]
            ] );
        }
    }

    public function store( StoreCategoryRequest $request ) {
        $validated = $request->validated();
        if ( $validated ) {
            $category = new Category;
            $category->title = $request->title;
            $category->desc = $request->description;
            $category->thumbnail_alt = $request->thumbnail_alt;
            $category->lang = $request->language;
            $category->seo_desc = $request->seo_desc;
            $category->top_category_id = $request->top_category_id;
            $category->is_private = $request->is_private;
            $category->show_in_footer = $request->show_in_footer;
            $category->show_in_navigation = $request->show_in_navigation;

            //Upload image
            $image = $request->file( 'thumbnail' );
            $storagePath = Storage::disk('public')->put('thumbnail/category', $image);

            if ($storagePath) {
                $category->thumbnail = basename(basename($storagePath));
            }

            $category->save();

            return response()->json( [
                'data' => $category,
            ], 200 );
        }
    }

    public function update ( UpdateTopCategoryRequest $request, $id ) {
        $validated = $request->validated();
        if ( $validated ) {
            $category = Category::find( $id );
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
            if ( $request->hasFile( 'thumbnail' ) ) {
                Storage::delete('/thumbnail/category' . $category->thumbnail );
                $image = $request->file( 'thumbnail' );
                $storagePath = Storage::disk('public')->put('thumbnail/category', $image);

                if ($storagePath) {
                    $category->thumbnail = basename(basename($storagePath));
                }
            }

            $category->save();

            return response()->json( [
                'data' => $category,
            ], 200 );
        }
    }

    public function delete( $id ) {

    }
}