@extends('master')
@section('content')
@include('carousel')

<div class="container-fluid">
    <center>
        <br />
        <h2 style="border-bottom:7px solid orange; width:160px; border-radius:5px;">Products</h2>
    </center>
    <br /><br />
    <div class="row ">
        <div class="col-md-2">


            <ul class="list-group">
                @foreach($categories as $cat )

                <a href="/categories/{{$cat->name}}" class="list-group-item list-group-item-action">{{$cat->name}}</a>

                @endforeach
            </ul>


        </div>

        @foreach($products as $product)
        <div class="col-md-2">
            <div class="card shadow">
                <img class="card-img-top img-fluid" id="image" src={{ asset('images/'.$product->image) }} alt="Card image">
                <div class="card-body">
                    <h4 class="card-title">{{$product->name}}</h4>
                    <p class="card-text">{{$product->description}}</p>
                    <p class="card-text" style="color:red">Rs:{{$product->price}}</p>
                    <a href="/viewproduct/{{$product->id}}" class="btn btn-primary">view product</a>
                </div>
            </div>
            <br />
        </div>

        @endforeach

    </div>

</div>

@endsection
