@extends('layouts.guest')

@section('title', 'Sapek-Group | ' .$categories->name)
@section('content')

<div aria-label="breadcrumb" class="bg-light pb-2 container col-sm-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$categories->name}}</li>
        </ol>
        <h2 class="pl-3" style="color: #2f9f00">{{strtoupper($categories->name)}}</h2>
    </div>


    <div class="container col-sm-9 ">
        <div class="row d-flex justify-content-center">
            @foreach($categories->products as $product)
                <div class="card col-sm-3 text-center m-3">
                    <div class="card-img-top">
                        <img class="w-100" src="{{asset('product_image/'.$product->primary_image)}}">
                    </div>
                    <div class="card-body">
                        <label>
                            <b><a href="{{route('product.show', $product->slug)}}" class="text-dark" style="text-decoration: none;">{{$product->name}}</a></b>
                        </label><br>
                        <label><td>Rp. {{ number_format($product->price, 2, ',','.') }}</td></label><br>
                        @if($product->stock > 0)
                            <label style="color: #2f9f00; font-size: small;">Ready Stock</label><br>
                            <hr>
                        <button class="btn btn-sm w-100 btn-success" type="submit"><a class="text-dark" href="{{route('addToCart', $product->id)}}" style="text-decoration: none;">Beli</a></button>
                            <br>
                        @else
                            <label style="color: #2f9f00; font-size: small;">Out Of Stock</label><br>
                            <hr>
                        <button class="btn btn-sm w-100 btn-success" disabled="disabled">Beli</button>
                            <br>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <hr class="mt-sm-5" style="border-width: 5px; border-color: white;">

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                {!!$categories->products->links()!!}
            </ul>
        </nav>

    </div>

@endsection