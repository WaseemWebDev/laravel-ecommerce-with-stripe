@extends('master')

@section( 'content')


<div class="container">
    <br /><br />
    <div class="row justify-content-center">
        <div class="col-md-5">
            <form action="/upload" method="post"  enctype="multipart/form-data">
@csrf
    <div class=" form-group">
                <label for="email">Title:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter title" name="title">
        </div>
        <div class="form-group">
            <label for="pwd">Description:</label>
            <input type="text" class="form-control"  placeholder="Enter description" name="description">
        </div>
        <div class="form-group">
            <label for="pwd">Price:</label>
            <input type="text" class="form-control"  placeholder="Enter price" name="price">
        </div>
        <div class="form-group">
            <label for="pwd">image:</label>
            <input type="file" class="form-control" name="image">
        </div>

        <button type="submit" class="btn btn-success">upload</button>
        </form>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
</div>

@endsection
