<?php

namespace WimmCMS\core\Http\Controllers;

use WimmCMS\core\Models\Article;
use WimmCMS\core\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Facades\Storage;
use WimmCMS\core\Models\Category;

class ArticleController extends Controller
{

    public function all( /*$sort = 'DEFAULT', $where = null, $whereOperator = null, $whereValue = null*/ ) {
        $articles = Article::with('category')->get();

        return response()->json( ['data' => [
            'statusCode' => '200',
            'article' => $articles,
        ]] );
    }

    public function view( $id ) {
        $article = Article::find( $id );
        $category = Category::find($article->category_id);

        if ( $article ) {
            return response()->json( ['data' => [
                'statusCode' => 200,
                'article' => [
                    'id' => $article->id,
                    'title' => $article->title,
                    'content' => $article->content,
                    'lang' => $article->lang,
                    'cover' => $article->cover,
                    'cover_alt' => $article->cover_alt,
                    'is_private' => $article->is_private,
                    'category' => $category
                ]
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
            $article->content = $request->description;
            $article->cover_alt = $request->thumbnail_alt;
            $article->lang = $request->language;
            $article->seo_desc = $request->seo_desc;
            $article->is_private = $request->is_private;
            $article->show_in_footer = $request->show_in_footer;
            $article->show_in_navigation = $request->show_in_navigation;
            $article->category_id = $request->category_id;

            $image = $request->file( 'thumbnail' );
            $storagePath = Storage::disk('public')->put('thumbnail/article', $image);

            if ($storagePath) {
                $article->cover = basename(basename($storagePath));
            }

            $article->save();
            $article->category()->sync($request->category_id, false);

            return response()->json( [
                'data' => $article,
            ], 200 );
        }
    }
}
