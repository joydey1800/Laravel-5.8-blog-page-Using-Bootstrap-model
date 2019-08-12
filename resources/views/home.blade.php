@extends('layouts.app')

@section('content')



<div class="jumbotron container">
        <h1 class="display-4 text-center">My All Post</h1>
</div>
        
<table class="table table-striped table-dark table-bordered rounded-lg">
    <thead>
      <tr>
        <th scope="col">Blog Number</th>
        <th scope="col">TiTle</th>
        <th scope="col">Created At</th>
        <th scope="col"><button data-toggle="modal" data-target="#addPost" type="button" class="btn btn-dark"><i class='fas fa-plus'></i></button></th>
      </tr>
    </thead>

       @php
             $no=1;
       @endphp
        @foreach ($posts as $post)

        <tbody>
            <tr>
              <th scope="row">{{$no++}}</th>
              <td>{{$post->title}}</td>
              <td>{{$post->created_at}}</td>
              <td>
              <a type="button" href="posts/{{$post->id}}" class="btn btn-info m-1"><i class='fas fa-eye'></i></a>
  
                      <button data-toggle="modal" data-target="#editPost" type="button" class="btn btn-warning m-1"><i class='fas fa-pen-alt'></i></button>
  
                      <button data-toggle="modal" data-target="#deletePost" type="button" class="btn btn-danger m-1"><i class='fas fa-trash-alt'></i></button>
              </td>
            </tr>
          </tbody>



{{------------------------------------------------------------------------------------------------}}
{{-------------------------------------Model Start -----------------------------------------------}}
{{------------------------------------------------------------------------------------------------}}
      

        
  
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
{{------------------------------------------------------------------------------------------------}}
{{-------------------------------------Model end -----------------------------------------------}}
{{------------------------------------------------------------------------------------------------}}


        @endforeach


      </table>



@endsection