<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WimmCMS\core\Models\Setting;

class AppController extends Controller
{
    public function view() {
        $settings = Setting::find(1);

        if ($settings) {
            return view('index')->withSettings($settings);
        } else {
            return view('index');
        }
    }
}
