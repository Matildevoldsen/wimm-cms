<?php

namespace WimmCMS\core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use WimmCMS\core\Http\Requests\StoreHomeRequest;
use WimmCMS\core\Models\Home;

class HomeController extends Controller {
    public function view($id) {
        $home = Home::find( $id );

        if ( $home ) {
            return response()->json( ['data' => [
                'statusCode' => 200,
                'category' => $home,
            ]] );
        } else {
            return response()->json( [
                'errors' => [
                    'root' => 'Error while loading home page. Please try again'
                ]
            ] );
        }
    }

    public function store(StoreHomeRequest $request) {
        $validated = $request->validated();
        if ( $validated ) {
            $home = new Home;
            $home->title         = $request->name;
            $home->nav_title  = $request->displayName;
            $home->content  = $request->description;
            $home->show_articles = $request->showArticles;
            $home->sort_by       = $request->sortBy;
            $home->layout_type       = $request->layout;

            $image = $request->file( 'thumbnail' );
            $storagePath = Storage::disk('public')->put('thumbnail/home', $image);

            if ($storagePath) {
                $home->thumbnail = basename(basename($storagePath));
            }

            $home->save();

            return response()->json( [
                'data' => $home,
            ], 200 );
        }
    }

    public function update() {

    }
}