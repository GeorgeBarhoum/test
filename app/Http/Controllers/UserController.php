<?php

namespace App\Model\user;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //or use this method seen on google
    // public function logout()
//   {
//     Auth::logout();
//     return redirect('/');
//   }


//   /*
// 	 * Display the posts of a particular user
// 	 * 
// 	 * @param int $id
// 	 * @return Response
// 	 */
//   public function user_posts($id)
//   {
//     //
//     $posts = Posts::where('author_id', $id)->where('active', '1')->orderBy('created_at', 'desc')->paginate(5);
//     $title = User::find($id)->name;
//     return view('home')->withPosts($posts)->withTitle($title);
//   }

//   public function user_posts_all(Request $request)
//   {
//     //
//     $user = $request->user();
//     $posts = Posts::where('author_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
//     $title = $user->name;
//     return view('home')->withPosts($posts)->withTitle($title);
//   }

//   public function user_posts_draft(Request $request)
//   {
//     //
//     $user = $request->user();
//     $posts = Posts::where('author_id', $user->id)->where('active', '0')->orderBy('created_at', 'desc')->paginate(5);
//     $title = $user->name;
//     return view('home')->withPosts($posts)->withTitle($title);
//   }

//   /**
//    * profile for user
//    */
//   public function profile(Request $request, $id)
//   {
//     $data['user'] = User::find($id);
//     if (!$data['user'])
//       return redirect('/');

//     if ($request->user() && $data['user']->id == $request->user()->id) {
//       $data['author'] = true;
//     } else {
//       $data['author'] = null;
//     }
//     $data['comments_count'] = $data['user']->comments->count();
//     $data['posts_count'] = $data['user']->posts->count();
//     $data['posts_active_count'] = $data['user']->posts->where('active', 1)->count();
//     $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
//     $data['latest_posts'] = $data['user']->posts->where('active', 1)->take(5);
//     $data['latest_comments'] = $data['user']->comments->take(5);
//     return view('admin.profile', $data);
//   }



//Second method

//  /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('auth:admin');
//     }

//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         $users = admin::all();
//         return view('admin.user.show',compact('users'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         $roles = role::all(); 
//         return view('admin.user.create',compact('roles'));
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         $this->validate($request,[
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
//             'phone' => ['required', 'numeric'],
//             'password' => ['required', 'string', 'min:8', 'confirmed'],
//         ]);

//         $request['password'] = bcrypt($request->password);
//         $user = admin::create($request->all());
//         $user->roles()->sync($request->role);
//         return redirect(route('user.index'));
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         $user = admin::find($id);
//         $roles = role::all();
//         return view('admin.user.edit',compact('user','roles'));
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         $this->validate($request,[
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email', 'max:255'],
//             'phone' => ['required', 'numeric'],
            
//         ]);

//         $request->status? : $request['status']=0;
//         $user = admin::where('id',$id)->update($request->except('_token','_method','role'));
//         admin::find($id)->roles()->sync($request->role);
//         return redirect(route('user.index'))->with('message','User updated successfully');

//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         admin::where('id',$id)->delete();
//         return redirect()->back()->with('message','User is deleted successfully');
//     }









}
