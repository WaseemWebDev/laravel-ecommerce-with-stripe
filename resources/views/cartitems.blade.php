@extends('master')
@section('content')



<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <br /><br />

    <div class="row">
        <div id="product" class="col-md-5">
        </div>
    
        
        {{-- <div class="col-md-5">
            @foreach($products as $product)
            <div class="card">
                <div class="card-body">
        <img class="img-fluid" src={{ asset('images/'.$product->attributes->image) }} alt="Card image" style="max-height:100px">
        <h5 class="card-title">{{$product->name}}</h5>
        <p class="card-text">Rs : {{$product->price}}</p>
        <p class="card-text">Quantity : {{$product->quantity}}</p>
        <a href="/removeproduct/{{$product->id}}" class="btn btn-danger">remove</a>

    </div>
</div>
<br />
@endforeach
</div> --}}


<form method="post">
    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
</form>
</div>
</div>
<center><a href="/stripe" class="btn btn-primary">checkout</a></center>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        getCartItem();

        function getCartItem() {
            $.ajax({
                type: 'get'
                , url: '/viewitems'
                , cache: false
                , success: function(response) {
                    $("#product").html(response)
                    console.log(response)
                }

            })
        }


        $("#add").click(function() {
            var name = $("#product-name").html();
            var price = $("#product-price").html();
            var image = $("#image").val();
            var id = $("#product-id").val();

            $.ajax({
                type: 'post'
                , url: '/addproduct'
                , data: {
                    _token: $("#csrf").val()
                    , id: id
                    , name: name
                    , price: price
                    , image: image
                }
                , success: function(data) {
                    alert(data)
                }
            });

        });
        $(document).on("click", ".increase-quantity", function() {
            var id = $(this).attr("data-id");
            $.ajax({
                type: 'post'
                , url: '/increasequantity'
                , data: {
                    _token: $("#csrf").val()
                    , id: id
                }
                , success: function(data) {
                    getCartItem()
                }
            });
        });
        $(document).on("click", ".decrease-quantity", function() {
            var id = $(this).attr("data-id");
            $.ajax({
                type: 'post'
                , url: '/decreasequantity'
                , data: {
                    _token: $("#csrf").val()
                    , id: id
                }
                , success: function(data) {
                    getCartItem()
                }
            });
        });
    });

</script>

@endsection
