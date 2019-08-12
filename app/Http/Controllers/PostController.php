<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\http\Requests;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('pages.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        

          $this->validate($request ,[
              'title' => 'required',
              'body' => 'required',
              'cover_img' => 'nullable|max:5000|image'
          ]);
          
          if($request->hasFile('cover_img')){
             
             $userid = Auth()->user()->id;
             $fileNmaeWithStore = $request->file('cover_img')->getClientOriginalName();
             $fileOnlyNmae = pathinfo($fileNmaeWithStore, PATHINFO_FILENAME);
             $fileOlyextention = $request->file('cover_img')->getClientOriginalExtension();
             $fileNameToStore ='ajaxblog_'.time().$userid.'.'.$fileOlyextention;
             $path = $request->file('cover_img')->storeAs('public/cover_img', $fileNameToStore);
             $pathsimg = public_path('storage/cover_img/'.$fileNameToStore);
             $img = Image::make($pathsimg)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
             
             $img->save($pathsimg);
            } else{
                $fileNameToStore = 'noimage.jpg';
            }

          $post = new Post;
          $post->title = $request->input('title');
          $post->body = $request->input('body');
          $post->cover_img = $fileNameToStore;
          $post->user_id = Auth()->user()->id;
          $post->save();

          
          return redirect('/home')->with('success', 'Post Created');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('pages.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

          if($request->hasFile('cover_img')){

            $userid = Auth()->user()->id;
            $fileNmaeWithStore = $request->file('cover_img')->getClientOriginalName();
            $fileOnlyNmae = pathinfo($fileNmaeWithStore, PATHINFO_FILENAME);
            $fileOlyextention = $request->file('cover_img')->getClientOriginalExtension();
            $fileNameToStore ='ajaxblog_'.time().$userid.'.'.$fileOlyextention;
            $path = $request->file('cover_img')->storeAs('public/cover_img', $fileNameToStore);
            $pathsimg = public_path('storage/cover_img/'.$fileNameToStore);
            $img = Image::make($pathsimg)->fit(320, 240)->save($pathsimg);

           }
         
          $post = Post::find($id);
          $post->title = $request->input('title');
          $post->body = $request->input('body');
          if($request->hasFile('cover_img')){
            $post->cover_img = $fileNameToStore;
            if($Post->cover_img != 'noimage.jpg'){
                Storage::delete('public/cover_img/'.$post->cover_img);
            }
           }
          $post->save();
          return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $post = Post::find($id);

        if($post->cover_img != 'noimage.jpg'){
            Storage::delete('public/cover_img/'.$post->cover_img);
        }
               
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
