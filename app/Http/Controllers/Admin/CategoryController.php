<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Category;
use Storage;

class CategoryController extends Controller
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
        if (! Gate::allows('category_access')) {
            return abort(401);
        }

        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (! Gate::allows('category_create')) {
            return abort(401);
        }

        return view('admin.category.create');
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
            'name' => 'required',
        ]);

        $categories = new Category;
        $categories->name = $request->name;
        $categories->slug = str_slug($request->name);

        if($request->hasFIle('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalName();
            $ServicesPath = public_path('/category_images');
            $file->move($ServicesPath, $fileName);
            $categories->image = $fileName;
        }

        $categories->save();

        return redirect()->route('admin.category.index')->withInfo('Category '.$categories->name.' telah berhasil di buat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        if (! Gate::allows('category_view')) {
            return abort(401);
        }

        $categories = Category::findOrFail($id);

        return view('admin.category.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if (! Gate::allows('category_edit')) {
            return abort(401);
        }

        return view('admin.category.edit');
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
        $categories = Category::findOrFail($id);
        $categories->name = $request->name;
        $categories->slug = str_slug($request->name);

        if($request->hasFIle('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalName();
            $ServicesPath = public_path('/category_images');
            $file->move($ServicesPath, $fileName);
            $categories->image = $fileName;
        }
        $categories->save();

        return back()->withInfo('Category '.$categories->name.' telah berhasil di perbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::findOrFail($id);\
        Storage::delete($categories->image);
        $categories->delete();

        return back()->withInfo('Category telah berhasil di hapus');
    }

     /**
     * Delete all selected at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('bus_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Category::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                Storage::delete($entry->image);
                $entry->delete();
            }
        }
    }
}
