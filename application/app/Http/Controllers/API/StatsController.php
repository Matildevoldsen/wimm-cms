<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class StatsController extends Controller
{
    public function getStatsForFullMonth()
    {
        $today = Carbon::today();

        $users = DB::table('users')->whereMonth('created_at', Carbon::now()->month)
            ->get()->count();
        $articles = DB::table('articles')->whereMonth('created_at', Carbon::now()->month)
            ->get()->count();
        $categories = DB::table('categories')->whereMonth('created_at', Carbon::now()->month)
            ->get()->count();

        if (Auth::user() && Auth::user()->admin == 1) {
            return response()->json(['data' => [
                'statusCode' => '200',
                'users' => $users,
                'articles' => $articles,
                'categories' => $categories
            ]]);
        }
    }
}
