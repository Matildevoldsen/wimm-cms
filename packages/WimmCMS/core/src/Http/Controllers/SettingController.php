<?php

namespace WimmCMS\core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use WimmCMS\core\Http\Requests\StoreSettingsRequest;
use WimmCMS\core\Models\Setting;

class SettingController extends Controller
{
    public function view($id) {
        $settings = Setting::find( $id );

        if ( $settings ) {
            return response()->json( ['data' => [
                'statusCode' => 200,
                'category' => $settings,
            ]] );
        } else {
            return response()->json( [
                'errors' => [
                    'root' => 'Error while loading site details. '
                ]
            ] );
        }
    }

    public function store(StoreSettingsRequest $request) {
        $validated = $request->validated();
        if ( $validated ) {
            $settings = new Setting;
            $settings->name             = $request->name;
            $settings->email            = $request->email;
            $settings->description      = $request->description;
            $settings->head             = $request->head;
            $settings->author           = Auth::user()->name;

            $image = $request->file( 'logo' );
            $storagePath = Storage::disk('public')->put('thumbnail', $image);

            if ($storagePath) {
                $settings->logo = basename(basename($storagePath));
            }

            $image = $request->file( 'favicon' );
            $storagePath = Storage::disk('public')->put('thumbnail', $image);

            if ($storagePath) {
                $settings->favicon = basename(basename($storagePath));
            }

            $settings->save();

            return response()->json( [
                'data' => $settings,
            ], 200 );
        }
    }

    public function update() {

    }
}
