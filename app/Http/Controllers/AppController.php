<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use WimmCMS\core\Models\Setting;

class AppController extends Controller
{
    public function view() {
        try {
            DB::connection()->getPdo();

            $settings = Setting::find(1);

            if ($settings) {
                return view('index')->withSettings($settings);
            }
        } catch (\Exception $e) {
            return view('setup');
        }
    }
}
