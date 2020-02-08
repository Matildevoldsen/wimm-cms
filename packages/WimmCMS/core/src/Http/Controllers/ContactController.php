<?php

namespace WimmCMS\core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use WimmCMS\core\Http\Requests\StoreContactRequest;
use WimmCMS\core\Models\Contact;

class ContactController extends Controller {
    public function view($id) {
        $contact = Contact::find( $id );

        if ( $contact ) {
            return response()->json( ['data' => [
                'statusCode' => 200,
                'category' => $contact,
            ]] );
        } else {
            return response()->json( [
                'errors' => [
                    'root' => 'Error while loading home page. Please try again'
                ]
            ] );
        }
    }

    public function store(StoreContactRequest $request) {
        $validated = $request->validated();
        if ( $validated ) {
            $contact = new Contact;
            $contact->title         = $request->name;
            $contact->nav_title  = $request->displayName;
            $contact->content  = $request->description;
            $contact->email  = $request->email;

            $image = $request->file( 'thumbnail' );
            $storagePath = Storage::disk('public')->put('thumbnail/contact', $image);

            if ($storagePath) {
                $contact->thumbnail = basename(basename($storagePath));
            }

            $contact->save();

            return response()->json( [
                'data' => $contact,
            ], 200 );
        }
    }

    public function update() {

    }
}