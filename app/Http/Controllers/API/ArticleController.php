<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function all( /*$sort = 'DEFAULT', $where = null, $whereOperator = null, $whereValue = null*/ ) {
        $articles = Article::all();
        return response()->json( ['data' => [
            'statusCode' => '200',
            'article' => $articles,
        ]] );
    }

    public function view( $id ) {
        $article = Article::find( $id );

        if ( $article ) {
            return response()->json( ['data' => [
                'statusCode' => 200,
                'article' => $article,
            ]] );
        } else {
            return response()->json( [
                'errors' => [
                    'root' => 'This top article does not exist'
                ]
            ] );
        }
    }

    public function store(StoreArticleRequest $request) {
        $validated = $request->validated();
        if ( $validated ) {
            $article = new Article;
            $article->title = $request->title;
            $article->description = $request->description;
            $article->thumbnail_alt = $request->thumbnail_alt;
            $article->lang = $request->lang;
            $article->seo_desc = $request->seo_desc;
            $article->top_article_id = $request->top_article_id;
            $article->is_private = $request->is_private;
            $article->show_in_footer = $request->show_in_footer;
            $article->show_in_navigation = $request->show_in_navigation;

            $image = $request->file( 'thumbnail' );
            $storagePath = Storage::disk('public')->put('thumbnail/article', $image);

            if ($storagePath) {
                $article->thumbnail = basename(basename($storagePath));
            }

            $article->save();

            return response()->json( [
                'data' => $article,
            ], 200 );
        }
    }
}
