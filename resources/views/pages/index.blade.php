@extends('layouts.app')
@section('content')

<div class="jumbotron text-center">
    
    <h1 class="display-3 text-monospace">All Post</h1>
    <button data-toggle="modal" data-target="#addPost" type="button" class="btn btn-dark"><i class='fas fa-plus'></i></button>
</div>



<div id="alltablepost">
    @if (count($posts)>0)
    @foreach ($posts as $post)
    
    <div class="card m-3" >
        <div class="card-header">
            <h3><strong>{{$post->title}}</strong></h3>
        </div>
        
        <div class="row no-gutters">
            <div class="col-md-1">
                <img src="/storage/cover_img/{{$post->cover_img}}" class="card-img img-thumbnail rounded" alt="JBlog">
            </div>
            <div class="col-md-11">
                <div class="card-body">
                              <h5 class="card-title">{!!$post->body!!}</h5>
                              <br>
                              <a class="btn btn-secondary btn-sm" href="/posts/{{$post->id}}">Read More</a>
                              <hr>
                              <p class="card-text">
                                  <small class="text-muted float-left">Created By: <strong>{{$post->user->name}}</strong></small>
                                  <small class="text-muted float-right">{{$post->created_at}}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

         
              @endforeach
              {{$posts->links()}}
          @else
              <p>Ther is no post</p>
          @endif

        </div>




        
      

        
        
@endsection