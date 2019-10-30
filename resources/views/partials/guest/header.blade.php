@inject('request', 'Illuminate\Http\Request')

<nav class="header navbar navbar-expand-lg navbar-dark primary-color">
    <div class="pr-3">
        <a href="#default" class="logo d-flex align-items-center"><img width="60px" src="{{asset('images/logo.png') }}"> <h2>xxx</h2></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <ul class="navbar-nav mr-auto">
            <li class="{{ $request->segment(1) == '' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Promo</a>
            </li>
            <li class="{{ $request->segment(1) == 'blog' ? 'active' : '' }} nav-item">
                <a class="nav-link" href="{{route('blog.index')}}">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tentang Kami</a>
            </li>
        </ul>

        <div class="ml-auto">
            <a class="btn btn-outline-light" href="{{route('auth.login')}}">Login</a>
            <a href="{{route('auth.regis')}}">Register</a>
        </div>
    </div>
</nav>