@extends('layouts.guest')

@section('content')
    @include('partials.guest.header') <br>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">GetBuss Live Support</div>

                <div class="card-body" id="app">
                    <chats></chats>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
