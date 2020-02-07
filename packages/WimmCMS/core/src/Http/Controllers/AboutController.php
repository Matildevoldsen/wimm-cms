<?php

namespace WimmCMS\core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use WimmCMS\core\Http\Requests\StoreAboutRequest;
use WimmCMS\core\Models\About;

class AboutController extends Controller {
    public function view($id) {
        $about = About::find( $id );

        if ( $about ) {
            return response()->json( ['data' => [
                'statusCode' => 200,
                'category' => $about,
            ]] );
        } else {
            return response()->json( [
                'errors' => [
                    'root' => 'Error while loading home page. Please try again'
                ]
            ] );
        }
    }

    public function store(StoreAboutRequest $request) {
        $validated = $request->validated();
        if ( $validated ) {
            $about = new About;
            $about->name         = $request->name;
            $about->displayName  = $request->displayName;
            $about->description  = $request->description;

            $image = $request->file( 'thumbnail' );
            $storagePath = Storage::disk('public')->put('thumbnail/about', $image);

            if ($storagePath) {
                $about->thumbnail = basename(basename($storagePath));
            }

            $about->save();

            return response()->json( [
                'data' => $about,
            ], 200 );
        }
    }

    public function update() {

    }
}