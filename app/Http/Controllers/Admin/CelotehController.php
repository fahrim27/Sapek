<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Product;
use App\ProductImages;
use App\Category;
use Auth;
use Storage;

class CelotehController extends Controller
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
        if (! Gate::allows('celoteh_access')) {
            return abort(401);
        }

        $celotehs = Product::all();
        return view('admin.celoteh.index', compact('celotehs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('celoteh_create')) {
            return abort(401);
        }

        $categories = Category::all();
        return view('admin.celoteh.create', compact('categories'));

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
            'price' => 'required|numeric',
            'primary_image' => 'required|image',
            'stock' => 'required|numeric',
            'descriptions' => 'required',
        ]);

        $celotehs = new Product;
        $celotehs->name = $request->name;
        $celotehs->price = $request->price;
        $celotehs->stock = $request->stock;
        $celotehs->model = $request->model;
        $celotehs->cat_id = $request->cat_id;
        $celotehs->slug = str_slug($request->name.'-'.$request->model);
        $celotehs->descriptions = $request->descriptions;

        if($request->hasFIle('primary_image')){
            $file = $request->file('primary_image');
            $fileName = time().'.'.$file->getClientOriginalName();
            $ServicesPath = public_path('/product_image');
            $file->move($ServicesPath, $fileName);
            $celotehs->primary_image = $fileName;
        }
        $celotehs->save();

        if($request->hasFIle('optional_images')){            
            foreach($request->file('optional_images') as $file)
            {
                $name = time().'.'.$file->getClientOriginalName();
                $Services = public_path('/product_image/optional');
                $file->move($Services, $name);

                $image = new ProductImages;
                $image->optional_images = $name;
                $image->product_id = $celotehs->id;

                $image->save();
            }
        }

        return redirect()->route('admin.celoteh.index')->withInfo('Product baru telah berhasi ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        if (! Gate::allows('celoteh_view')) {
            return abort(401);
        }

        $match = [
            ['product_id', '=', $id]
        ];

        $imgPro = ProductImages::where($match)->get();
        // used collect method to be able to sortBy
        $celotehs = Product::findOrFail($id);

        return view ('admin.celoteh.show', compact('celotehs', 'imgPro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('celoteh_edit')) {
            return abort(401);
        }

        $categories = Category::all();

        $celotehs = Product::findOrFail($id);

        return view('admin.celoteh.edit', compact('categories', 'celotehs'));
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
            'name' => 'required',
            'price' => 'require|numeric',
            'primary_image' => 'required',
            'stock' => 'required|numeric',
            'model' => 'required',
            'descriptions' => 'required',
        ]);

        $celotehs = Product::findOrFail($id);
        $celotehs->name = $request->name;
        $celotehs->price = $request->price;
        $celotehs->stock = $request->stock;
        $celotehs->model = $request->model;
        $celotehs->cat_id = $request->cat_id;
        $celotehs->slug = str_slug($request->name.'-'.$request->model);
        $celotehs->descriptions = $request->descriptions;

        if($request->hasFIle('primary_image')){
            $file = $request->file('primary_image');
            $fileName = time().'.'.$file->getClientOriginalName();
            $ServicesPath = public_path('/product_image');
            $file->move($ServicesPath, $fileName);

            $oldFilename = $celotehs->primary_image;
            \Storage::delete($oldFilename);
            $celotehs->primary_image = $fileName;
        }
        $celotehs->save();
    }

    /**
    *Edit optional image celoteh kopang
    *
    *@param int $id
    *
    */
    public function imgCelotehUpdate($id)
    {
        $celoteh_opImage = ProductImages::find($id);

        if($request->hasFIle('optional_images')){
            $file = $request->file('optional_images');
            $fileName = time().'.'.$file->getClientOriginalName();
            $ServicesPath = public_path('/product_image/optional');
            $file->move($ServicesPath, $fileName);

            $oldFilename = $celoteh_opImage->optional_images;
            \Storage::delete($oldFilename);
            $celoteh_opImage->optional_images = $fileName;
        }
        $celoteh_opImage->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $celotehs = Product::findOrFail($id);
        Storage::delete($celotehs->primary_image);
        $celotehs->delete();
        
        $match = [
            ['product_id', '=', $id]
        ];
        
        $imgClt = ProductImages::where($match)->delete();
        Storage::delete($imgClt->optional_images);
        $imgClt->delete();

        return back()->withInfo('Telah berhasil menghapus Foto Product');
    }

     /**
     * Delete all selected at once.
     *
     * @param Request $request
     */
        public function massDestroy(Request $request)
        {
            if (! Gate::allows('celoteh_delete')) {
                return abort(401);
            }
            if ($request->input('ids')) {
                $entries = Product::whereIn('id', $request->input('ids'))->get();

                foreach ($entries as $entry) {
                    Storage::delete($entry->primary_image);
                    $entry->delete();
                }
            }
        }

}
