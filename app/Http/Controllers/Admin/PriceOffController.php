<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\PriceOff;
use Auth;

class PriceOffController extends Controller
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
        $discountLists = PriceOff::orderBy('id', 'asc')->get();
        $products = Product::get()->pluck('name', 'id')->prepend('Select Product', '');

        return view('admin.priceOff.index', compact('discountLists', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get()->pluck('name', 'id')->prepend('Please select', '');

        return view('admin.priceOff.create', compact('products'));
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
            'pro_id' => 'required',
            'discount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $priceOffs = new PriceOff;
        $priceOffs->pro_id = $request->pro_id;
        $priceOffs->discount = $request->discount;
        $priceOffs->start_date = $request->start_date;
        $priceOffs->end_date = $request->end_date;

        if (PriceOff::where('pro_id', '=', $request->pro_id)->exists()) {
            return back()->withInfo('Product yang anda pilih telah ter Diskon');
        }
        else {
            $priceOffs->save();

            return redirect()->route('admin.list.index')->withInfo('Data Barang Telah Berhasil di Diskon, Silahkan Cek List dibawah ini');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::get()->pluck('name', 'id')->prepend('Please select', '');

        $priceOffs = PriceOff::findOrFail($id);

        return view('admin.priceOff.edit', compact('products', 'priceOffs'));
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
            'pro_id' => 'required',
            'discount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $priceOffs = PriceOff::findOrFail($id);
        $priceOffs->pro_id = $request->pro_id;
        $priceOffs->discount = $request->discount;
        $priceOffs->start_date = $request->start_date;
        $priceOffs->end_date = $request->end_date;

        $priceOffs->save();

        return redirect()->route('admin.list.index')->withInfo('Data Barang Telah Berhasil di Diskon, Silahkan Cek List dibawah ini');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priceOffs = PriceOff::find($id);
        $priceOffs->delete();

        return back()->withInfo('Data Diskon Barang Telah Berhasil di Hapus');
    }

    /**
     * Delete all selected at once.
     *
     * @param Request $request
     */
        public function massDestroy(Request $request)
        {
            if ($request->input('ids')) {
                $entries = PriceOff::whereIn('id', $request->input('ids'))->get();

                foreach ($entries as $entry) {
                    $entry->delete();
                }
            }
        }
}
