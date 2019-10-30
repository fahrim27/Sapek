@extends('layouts.guest')

@section('title', 'Sapek-Group | Cart')

@section('content')
<div aria-label="breadcrumb" class="bg-light pb-2 container col-sm-9">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">BELANJAAN</li>
    </ol>
    <h2 class="pl-3" style="color: #2f9f00">BELANJAAN</h2>
</div>

<div class="container col-sm-9 bg-light pb-sm-5">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead" align="center">
            <tr>
                <th>Action</th>
                <th>Gambar</th>
                <th>Nama Barang</th>
                {{-- <th>Model</th> --}}
                <th>Kuanitas</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
            </tr>
            </thead>
            @if(count($cartItems) < 1)
            <tbody align="center">
              <tr align="">
                  <h4 class="text-center">Cart Anda Kosong, Silahkan Lakukan Pembelian</h4>
              </tr>
            </tbody>

            @else
            
            <tbody align="center">
            @foreach($cartItems as $cart)
            <tr>
                <td class="align-middle">
                   <form action="{{route('deleteCart', $cart->rowId)}}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                       <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                  </form>
                  <form action="{{route('updateCart', $cart->rowId)}}" method="post">
                    {{ csrf_field() }}
                     {{ method_field('PUT') }}
                    <button class="btn btn-sm btn-primary" style="margin-top: 2%;"><i class="fa fa-pencil"></i> </button>
                </td>
                <td class="align-middle">
                    <img style="max-width: 120px" class="rounded"  src="http://localhost:8000/product_image/{{$cart->options->has('primary_image')?$cart->options->primary_image:''}}">
                    <input name="primary_image" type="hidden" value="{{$cart->options->has('primary_image')?$cart->options->primary_image:''}}">
                </td>
                <td class="align-middle" >
                    <label>{{$cart->name}}</label><br>
                    <label>Warna : -</label>
                </td>
             
                <td class="align-middle" >
                    <div class="wrapper">
                        <select name="qty" class="form-control" value="{{$cart->qty}}" onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            <option value="" disabled selected>{{$cart->qty}}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </td>
                <td class="align-middle" >
                    <label>Rp. {{ number_format($cart->price, 2, ',','.')}}-</label>
                </td>
                <?php 
                    $subTotalProduct = $cart->price * $cart->qty;
                 ?>
                <td class="align-middle" >
                    <label>Rp. {{ number_format($subTotalProduct, 2, ',','.')}}-</label>
                </td>
                </form>
            </tr>
            @endforeach
            </tbody>
            @endif
        </table>
    </div>
  <div class="container row d-flex col-12">
      <div class="col-auto mr-auto">
          <div>
              <button class="btn btn-outline-success mb-4">
                  Lanjut Belanja
              </button>
          </div>
      </div>
      <div class="col-auto">
          <div class="">
              <div>
                  <label>Sub-total :</label>
                  <label>Rp. {{ Cart::subtotal()}}-</label>
              </div>
              <div>
                  <label>Pajak Admin :</label>
                  <label>{{Cart::tax()}}-</label>
              </div>
              <div>
                  <h5>
                      Total : Rp. {{ Cart::total() }}-
                  </h5>
              </div> <br>
              @if(count($cartItems) < 1)
              <button class="btn btn-success mb-4 disabled pull-right" type="button">Bayar</button>
              @else
              <a href=""><button class="btn btn-success mb-4 active pull-right" type="submit">Bayar</button></a>
              @endif
          </div>
      </div>
  </div>
</div>


@endsection