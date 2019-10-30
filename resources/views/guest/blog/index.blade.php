@extends('layouts.guest')

@section('content')

<br>
<div class="container-fluid">
        <section class="section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                <div class="well well-sm wl" style="background-color: rgba(47, 158, 0, 0.45);">
                    
                    <div class="btn-group">
                        <a href="#" id="list" class="btn btn-default btn-md"><i class="fa fa-th-list text-dark">
                        </i> List</a>
                        <a href="#" id="grid" class="btn btn-default btn-md"><i
                            class="fa fa-th text-dark"></i> Grid</a>
                    </div>
                </div>
        
      <div id="grid_post" class="row">

   
      @foreach($blogs as $blog)
         <div class="item  col-xs-4 col-lg-4" >
            <div class="card mb-3">
              <h4 class="card-header text-white bg-primary" style="margin-top: -10px;">{{$blog->title}}</h4>
              <img style="height: 200px; width: 100%; display: block;" src="{{asset('blog_images/'.$blog->image)}}" alt="Card image">
              <div class="card-body">
                <p class="card-text">{!! str_limit($blog->content,150) !!}</p>
               <button type="button" class="btn btn-primary card-link text-white" style="margin: 0 auto;"><a href="{{route('blog.show', $blog->slug)}}" class="text-white">Read more</a></button>
              </div>
              <div class="card-footer text-muted">
                {{date ('j F Y, h:ia', strtotime($blog->created_at))}}
              </div>
            </div>
        </div>
      @endforeach
  
  </div><!-- end grid -->
</div>
    @include('extra.sidebar')
    
    </div><!-- end row -->
</div>
        </section>
        <!-- FOOTER --> 
         <!-- <div class="text-center d-flex justify-content-center">
                <ul class="pagination">
                <li class="page-item disabled">
                  <a class="page-link" href="#">&laquo;</a>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">4</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">5</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">&raquo;</a>
                </li>
              </ul>
            </div>
         </div> -->
        <!-- END FOOTER --> 
        <div class="text-center">
                <ul class="pagination">
                  {!!$blogs->links()!!}
                </ul>
         </div>
</div><!-- end con fluid -->

@endsection