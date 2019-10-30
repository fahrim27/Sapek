<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Tag;
use App\User;
use App\Blog;
use App\Comment;
use Storage;

class BlogController extends Controller
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
        if (! Gate::allows('blog_access')) {
            return abort(401);
        }

        $blogs = Blog::all();
        $tags = Tag::all();

        return view('admin.blog.index', compact('blogs', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (! Gate::allows('blog_create')) {
            return abort(401);
        }

        $blogs = Blog::all();
        $tags = \App\Tag::get()->pluck('name', 'id');

        return view('admin.blog.create', compact('blogs', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
            'tags' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg',
        ]);

        $blogs = new Blog;
        $blogs->title = $request->title;
        $blogs->slug = str_slug($blogs->title);
        $blogs->content = $request->content;
 
        if($request->hasFIle('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/blog_images');
            $file->move($destinationPath, $fileName);
            $blogs->image = $fileName;
        }
        

        $blogs->save();
        $blogs->tags()->sync($request->tags);

        // $subscribers = Subscriber::all();
        // foreach($subscribers as $subscriber)
        // {
        //     Notification::route('mail',$subscriber->email)
        //     ->notify(new NewPostNotification($posts));
        // }
        
        return redirect()->route('admin.blog.index')->withInfo('Anda telah berhasil membuat Post Blog baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tags = Tag::orderBy('id','desc')->paginate(3);
        $blogs = Blog::where('id','=', $id)->first();
        $blogs->comments = Comment::orderBy('id', 'desc')->paginate(5);

        return view ('admin.blog.show', compact('blogs', 'tags', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if (! Gate::allows('blog_edit')) {
            return abort(401);
        }

        $posts = Post::find($id);
        $tags = Tag::all();
        return view('admin.blog.edit', compact('posts', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
            'tags' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        $blogs = Blog::find($id);
        $blogs->title = $request->title;
        $blogs->content = $request->content;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/blog_images');
            $file->move($destinationPath, $fileName);

            $oldFilename = $blogs->image;
            \Storage::delete($oldFilename);
            $blogs->image = $fileName;
        }

        $blogs->save();
        $blogs->tags()->sync($request->tags);
        return back()->withInfo('berhasil mengedit post'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogs = Blog::find($id);
        Storage::delete($blogs->image);
        $blogs->tags()->detach();

        $blogs->delete();

        return back()->withInfo('Blog dengan judul '.$blogs->name.' telah berhasil di hapus');
    }

    /**
     * Delete all selected at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('blog_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Blog::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                Storage::delete($entry->image);
                $entry->tags()->detach();

                $entry->delete();
            }
        }
    }
}
