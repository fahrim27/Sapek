@extends('layouts.guest')

@section('content')

	<div aria-label="breadcrumb" class="bg-light pb-2 container col-sm-9">
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	        <li class="breadcrumb-item"><a href="{{route('category.show', $products->category->id)}}">{{$products->category->name}}</a></li>
	        <li class="breadcrumb-item active text-dark" aria-current="page">{{$products->name}}</li>
	    </ol>
	    <h2 class="pl-3" style="color: #2f9f00">{{strtoupper($products->name)}}</h2>
	</div>

	<div class="container d-flex col-sm-9 justify-content-center bg-light">
	    <div class="row">
	        <div class="pr-5 col-7">
	            <img class="w-100" src="{{asset('product_image/'.$products->primary_image)}}">
	        </div>
	        <div class="col-5">
	            <h1>{{strtoupper($products->name)}}</h1>
	            <label>Rp. {{ number_format($products->price, 2, ',','.') }}</label> <br>
	            <table>
	                <tbody>
	                <tr>
	                    <td>Stock :</td>
	                    @if($products->stock > 0)
	                    <td>Ready</td>
	                    @else
	                    <td>Out Of Stock</td>
	                    @endif
	                </tr>
	                <tr>
	                    <td>Model :</td>
	                    @if($products->model = NULL)
	                    <td>-</td>
	                    @else
	                    <td>BackPack</td>
	                    @endif
	                </tr>
	                <tr>
	                    <td>Warna :</td>
	                    <td class="pt-2">
	                        <select class="form-control">
	                            <option value="merah">Merah</option>
	                            <option value="biru">Biru</option>
	                            <option value="kuning">Kuning</option>
	                        </select>
	                    </td>
	                </tr>
	                <tr>
	                    <td>Qty :</td>
	                    <td class="pt-2">
	                        <div class="d-flex">
	                            <div class="input-group mb-3">
	                                <div class="input-group-prepend">
	                                    <button class="btn btn-success" type="button"><b>+</b></button>
	                                </div>
	                                <input type="number" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
	                                <div class="input-group-append">
	                                    <button class="btn btn-success" type="button"><b>-</b></button>
	                                </div>
	                            </div>

	                        </div>
	                    </td>
	                </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
	<div class="container col-sm-9 bg-light">
	    <div class="col-sm-10 d-flex justify-content-end">
	        <button class="btn btn-outline-success">Batal</button>
	        <button class="btn btn-success ml-2">Beli</button>
	    </div>
	</div>
	<div class="container col-sm-9 bg-light">
	    <h3 style="color: #2f9f00">DESKRIPSI</h3>
	    <textarea rows="15" class="form-control col-sm-8" readonly="readonly">
	    	{!! $products->descriptions !!}
	    </textarea>
	</div>
	<div class="container col-sm-9 bg-light">
	    <h3 style="color: #2f9f00">Produk Sejenis</h3>
	    <div class="row d-flex">
	            <div class="card col-sm-2 text-center m-3">
	                <div class="card-img-top">
	                    <img class="w-100" src="image/item.jpg">
	                </div>
	                <div class="card-body">
	                    <label>
	                        <b>barang no
	                            
	                        </b>
	                    </label><br>
	                    <label>Rp.410.000</label><br>
	                    <label style="color: #2f9f00; font-size: small;">Ready Stock</label><br>
	                    <hr>
	                    <button class="btn btn-sm w-100 btn-success">Beli</button>
	                    <br>
	                </div>
	            </div>
	    </div>
	</div>

@endsection