<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CategoryController;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use GuzzleHttp\Middleware;

class LikeController extends Controller
{
    public function __invoke($slug)
    {
        // //get the requested like
        // $like = Like::query()
        //     ->where('slug', $slug)
        //     ->firstOrFail();

        //get the articles with that like
        $articles = $likes->articles()
            ->where('is_published',true)
            ->orderBy('id','desc')
            ->paginate(env('PAGE_NUMBER'));

        //get all the categories
        $categories = Category::all();

        //get all the likes
        $likes = Like::all();

        //get the recent 5 articles
        $recent_articles = Articles::query()
            ->where('is_published',true)
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();

        //return the data to the corresponding view
        return view('like', [
            'like' => $like,
            'articles' => $articles,
            'categories' => $categories,
            'likes' => $likes,
            'recent_articles' => $recent_articles
        ]);
    }
}

// what is this ??????????????????????????????????
//Article::create($request->all()); 