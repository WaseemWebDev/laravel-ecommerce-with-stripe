@extends('master')
@section('content')



<div class="container">
    <br /><br />
    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid" src={{ asset('images/'.$product->image) }} alt="Card image" style="width:100%">
            <input type="hidden" value={{$product->image}} id="image" />
        </div>
        <div class="col-md-4">
            <br /><br />
            <h5>Product Name</h5>
            <h5 style="color:grey" id="product-name">{{$product->name}}</h5>
            <br />
            <h5>Description</h5>
            <h5 style="color:grey" id="product-desc">{{$product->description}}</h5>
            <br />
            <h5>Price</h5>
            <h5 style="color:red" id="product-price">{{$product->price}}</h5>
            <br />
            <input type="hidden" id="product-id" value={{$product->id}} />

            <button class="btn btn-primary" id="add">Add to Cart</button>
            <form method="post">
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
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
    });

</script>

@endsection
