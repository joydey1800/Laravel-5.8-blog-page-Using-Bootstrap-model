@extends('layouts.app')
@section('content')


<div class="card mx-4">
        <h5 class="card-header">{{$post->title}}</h5>
        <div class="card-body">
          <h5 class="card-title">Created By: <strong>{{$post->user->name}}</strong></h5>
          <br>
        <img src="/storage/cover_img/{{$post->cover_img}}" class="card-img-top img-thumbnail rounded mx-auto d-block" alt="JBlog" style="width:400px; height:auto;">
          
          <p class="card-text mt-4"><strong>{!!$post->body!!}</strong></p>
        </div>
        <div class="card-footer text-muted">
            <small class="card-text d-md-inline">Written On: {{$post->created_at}}</small>
            <small class="card-text float-md-right">Updated On: {{$post->updated_at}}</small>
        </div>
    </div>

    @if (!Auth::guest())
      @if (Auth::user()->id == $post->user_id)
            
        <div class="my-4 mx-4">
            <button data-toggle="modal" data-target="#editPost" type="button" class="btn btn-warning m-1"><i class='fas fa-pen-alt'></i></button>

            <button data-toggle="modal" data-target="#deletePost" type="button" class="btn btn-danger m-1 float-right"><i class='fas fa-trash-alt'></i></button>

        </div>
        
      @endif
    @endif


    {{-- comment section --}}

    <div class="card mx-4 mb-4">
      <h6 class="card-header">All Comment</h6>
      <div class="card-body">


 @foreach ($post->comments as $comment)

     <p class="card-text mt-4"><strong>{{$comment->user->name}}: </strong>{{$comment->body}}</p>

 @endforeach
          

             <form action="{{route('addcomment', $post->id)}}" method="POST">
              {{csrf_field()}}

                  {{-- Post body input --}}
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Comment" name="comment" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Comment</button>
                    </div>
                  </div>
             </form>
      </div>
      <div class="card-footer text-muted">
      </div>
  </div>


    
     
  <!------------------------------------------------------------------------------------------------>
        <!-- Edit Post -->
        <div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="editPostScrollableTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editPostScrollableTitle">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('put')

                  <div class="modal-body">

                        {{-- Post title input --}}
                        <div class="input-group input-group-lg my-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-lg">Post Title</span>
                            </div>
                          <input type="text" name="title" class="form-control" aria-label="Post Title"aria-describedby="inputGroup-sizing-sm" value="{{$post->title}}">
                        </div>
        
                        {{-- Post Image input --}}
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                  <input type="file" name="cover_img" class="custom-file-input" id="inputGroupFile01">
                                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                         </div>
        
                        {{-- Post body input --}}
                        <div class="input-group input-group-lg my-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">Post Body</span>
                                </div>
                                <textarea class="form-control" id="article-ckeditor" name="body" aria-label="With textarea">{{$post->body}}</textarea>
                        </div>
                        
        
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>

                </form>


                </div>
              </div>
            </div>


             <!-- delete Post -->
        <div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="deletePostScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deletePostScrollableTitle">Delete Post</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-danger text-bold">
                    Are You Sure Want To Delete This Post?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                  <form action="{{route('posts.destroy', $post->id)}}" method="POST" enctype="multipart/form-data">
                      {{csrf_field()}}
                      @method('delete')
                      <button type="submit" class="btn btn-danger">Delete</button>
                  </form>

                </div>
              </div>
            </div>
          </div>
      
    
@endsection
