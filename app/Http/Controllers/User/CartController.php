<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Cart;
use Auth;
use App\Sewa;

class CartController extends Controller
{
    public function addToCart($id)
    {
    	$product = Product::find($id);
    	Cart::add($id, $product->name,1,$product->price,['primary_image' => $product->primary_image]);

    	return back()->withInfo(' Telah Berhasil di Tambahkan Kedalam Cart.');
    }

    public function cartIndex(){
        $products = Product::paginate(1);
    	$cartItems = Cart::content();
    	return view ('guest.cart.index', compact('cartItems'));
    }

    public function updateCart(Request $request, $id){
        Cart::update($id,['qty' => $request->qty, "options" => ['primary_image' => $request->primary_image]]);

        return redirect()->back()->withInfo('massage', 'Updated.');
    }

    public function deleteCart($id){
        Cart::remove($id);

        return redirect()->back()->withInfo('massage', 'Deleted.');
    }

    public function storeCart()
    {
        Cart::instance('history')->store(Auth::user()->id);

        Cart::destroy();

        return redirect()->route('user.history.index')->withInfo('Item Belanja anda telah berhasil terekam, Silahkan lakukan Checkout ketika siap.');
    }

    public function restoreCart()
    {
        Cart::instance('history')->store(Auth::user()->id);

        return view('guest.cart.index')->withInfo('Item Belanja anda telah berhasil di restore, Silahkan melanjutkan belanja Anda. Terima Kasih!');
    }

    public function orderCart(Request $request)
    {
        if ($request->has('tanggal_sewa')) {
            $sewas = New Sewa;
            $sewas->user_id = Auth::user()->id;

            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'phone' => 'required|numeric',
                'zip' => 'required|numeric',
                'tanggal_sewa' => 'required',
                'tanggal_kembali' => 'required',
            ]);

            foreach (Cart::content() as $cart) {
                $sewas=Auth::user()->sewa()->create([
                    'qty' =>$cart->qty,
                    'tax' =>$cart->tax*$cart->qty,
                    'subtotal' =>$cart->subtotal,
                    'total' =>$cart->tax*$cart->qty+$cart->subtotal,
                    'title'=> $cart->name,
                    'image' =>$cart->options->has('image')?$cart->options->image:'',
                    'product_price' => $cart->price,
                    'name' =>$request->name,
                    'address'=> $request->address,
                    'city' =>$request->city,
                    'phone' =>$request->phone,
                    'zip'=> $request->zip,
                    'tanggal_sewa' => $request->tanggal_sewa,
                    'tanggal_kembali' => $request->tanggal_kembali,
                    'status' => 0,
                ]);
            }
            $sewas->save();    
        }
        else {
            $order = New Order;
            $order->user_id = Auth::user()->id;

            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'phone' => 'required|numeric',
                'zip' => 'required|numeric',
            ]);

            foreach (Cart::content() as $cart) {
                $order=Auth::user()->orders()->create([
                    'qty' =>$cart->qty,
                    'tax' =>$cart->tax*$cart->qty,
                    'subtotal' =>$cart->subtotal,
                    'total' =>$cart->tax*$cart->qty+$cart->subtotal,
                    'title'=> $cart->name,
                    'image' =>$cart->options->has('image')?$cart->options->image:'',
                    'product_price' => $cart->price,
                    'name' =>$request->name,
                    'address'=> $request->address,
                    'city' =>$request->city,
                    'phone' =>$request->phone,
                    'zip'=> $request->zip,
                    'status' => 0,
                ]);
            }
            $order->save();
        }

        Cart::destroy();
        return redirect()->route('thanks');
    }

}