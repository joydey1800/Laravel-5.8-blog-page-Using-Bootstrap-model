<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/myjs.js') }}"></script>
    <title>{{config('app.name')}}</title>
     </head>
     <body >

        
           @include('inc.nav')
           @include('inc.message')
           @yield('content')

        
    


           
   <!-- Add Post -->
   <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="addPostScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPostScrollableTitle">Add Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

    

          <form action="{{url('posts')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="modal-body">

            {{-- Post title input --}}
            <div class="input-group input-group-lg my-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-lg">Post Title</span>
                </div>
                <input type="text" name="title" class="form-control" aria-label="Post Title"aria-describedby="inputGroup-sizing-sm">
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
                      <textarea class="form-control" id="article-ckeditor" name="body" aria-label="With textarea"></textarea>
              </div>
              

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>

      </form>
      </div>
    </div>
  </div>

     </body>
</html>
