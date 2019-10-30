<div class="col-md-3">

      <div class="list-group" style="box-shadow: 0 0px 1px 0px rgba(0, 0, 0, 0.26);">
          <span class="list-group-item" style="background-color: #1e7e34;"><i class="fa fa-folder-o text-white">Total {{$tags->count()}} Tags </i><a href=""><small class="pull-right text-dark"> | Lihat Semua <i class="fa fa-share "></i> </small></a></span>
            @if(count($tags) < 1)
              <a href="#" class="list-group-item">
                <i class="fa fa-tags" style="color: #1e7e34;"> There are no Tags</i>
                <small class="badge badge-success pull-right">0 <i class="fa fa-newspaper-o" aria-hidden="true"></i></small>
              </a>   
            @else
              @foreach($tags as $tag)
                  <a href="#" class="list-group-item">
                    <i class="fa fa-tags" style="color: #1e7e34;"></i> {{ str_limit($tag->name,10) }}
                      <small class="badge badge-success pull-right"> {{$tag->blog()->count()}} <i class="fa fa-newspaper-o" aria-hidden="true"></i></small>
                  </a>     
              @endforeach 
            @endif
        </div>

          <div class="ads-img" style="border: 11px solid #eee;">
            <img src="../images/sidebar.jpg" style="width: 100%; height: auto;">
          </div>

</div>

<style type="text/css">
  i{
    padding-bottom: 5px;
  }
</style>