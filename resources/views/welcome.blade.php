@extends('layouts.app')

@section('content')
<style>
.welcome_page{
    height: 92.5vh;
    width: 100vw;
    background: url('https://www.pixelstalk.net/wp-content/uploads/2016/08/Backgrounds-3D-Best-Download-768x480.jpg');
    background-repeat: no-repeat;
    background-size: cover;

}
.display-1{
    background-color: rgba(0, 0, 0, 0.7);
}
</style>
<div class="welcome_page d-flex flex-wrap align-content-center justify-content-center">
      <h1 class="display-1 text-light text-center p-2 p-4 rounded">Create Your Own Blog!</h1>
</div>
@endsection