<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Middleware;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::latest()->get();//paginate(5) and you call it in view by link function//  5 on page  1 2 3 4
        return view('article.index', ['articles' => $articles]);
        // return view('article.index',compact('article'));
         // {!! $articles->links() !!} in the view index

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
             return view('article.create');
        
        // paste here web.php return 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()==null){
            dd('unauthorized');
        }
         //return $request->all();
         $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
        ]);

        $articles = new Articles;
        $articles->user_id= auth()->user()->id;
        $articles->title= $request->title;
        //$articles->image = null;
        //$articles->subtitle= null;
        //$articles->slug= null;
        $articles->body= $request->body;
        //$articles->status= null;
        $articles->save();
        //below two line are afer save
        //$articles->likes()->sync($request->likes);
        //$articles->categories()->sync($request->categories);
        

        return redirect(route('articles.index'))->with('success','Add Article Success');
    }//return redirect()->route('articles.index') ->with('success_message', 'Article was successfully added!'); 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function show(Articles $articles)
    {
    
        //get the requested articles, if it is published
        $articles = Articles::query()
            ->where('is_published', true)
            //->where('slug', $slug)
            ->firstOrFail();

        //get all the categories
        $categories = Category::all();

        //get all the likes
        $likes = Like::all();

        //get the recent 5 articless
        $recent_articless = Articles::query()
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();


        //return the data to the corresponding view
        return view('articles', [
            'articles' => $articles,
            'categories' => $categories,
            'likes' => $likes,
            'recent_articless' => $recent_articless,
        ]);
    }

    public function search(Request $request)
    {
        $key = trim($request->get('q'));

        $articless = Articles::query()
            ->where('title', 'like', "%{$key}%")
            ->orWhere('content', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->paginate(env('PAGE_NUMBER'));

        //get all the categories
        $categories = Category::all();

        //get all the likes
        $likes = Like::all();

        //get the recent 5 articless
        $recent_articless = articles::query()
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('search', [
            'key' => $key,
            'articless' => $articless,
            'categories' => $categories,
            'likes' => $likes,
            'recent_articless' => $recent_articless
        ]);
    }


      /**
       * Show the form for editing the specified resource.
       * @param  \App\Models\Articles  $articles
       * @return \Illuminate\Http\Response
     */
    public function edit(Articles $articles)
    {
        if (Auth::user())->can('articles.update')){
            $articles = Articles::with('likes','categories')->where('id',$id)->first(); //you can use get() instead of first()
            $likes = Like::all();
            $categories = Category::all();
            return view('admin.articles.edit',compact('likes','categories','articles'));
        //return view('admin.articles.edit',compact('articles'));
        }
        return redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articles $articles, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'slug'=>'required',
            'body'=>'required',
            'image'=>'required',
        ]);

        if ($request->hasFile('image'))
        {
            $imageName = $request->image->store('public');
        }

        $articles = Articles::find($id);
        $articles->image = $imageName;
        $articles->title= $request->title;
        $articles->subtitle= $request->subtitle;
        $articles->slug= $request->slug;
        $articles->body= $request->body;
        $articles->status= $request->status;
        $articles->save();
        $articles->likes()->sync($request->likes);
        $articles->categories()->sync($request->categories);
        

        return redirect(route('articles.index'));
    }        

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articles $articles)
    {
        Articles::where('id',$id)->delete();
        return redirect()->back();
    }
}