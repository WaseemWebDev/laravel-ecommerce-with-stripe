<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Categories;
use Cart;

use Stripe;
use Session;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        $categories = Categories::all();
        return view("home", ['products' => $products, "categories" => $categories]);
    }
    public function createproduct()
    {
        return view("createproduct");
    }


    public function uploadproduct(Request $request)
    {
        $name =  $request->input("title");
        $description =  $request->input("description");
        $price =  $request->input("price");
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $imageUploaded =  $request->image->move(public_path('images'), $imageName);
        if ($imageUploaded) {
            $insertData =  DB::table('products')->insert(
                ['name' => $name, 'description' => $description, 'price' => $price, 'image' => $imageName]
            );
            if ($insertData > 0) {
                return back()
                    ->with('success', 'You have successfully upload image.');
            }
        }
    }
    public function viewproduct($id)
    {
        $product = Product::find($id);
        return view("products", ["product" => $product]);
    }
    public function viewcart()
    {


        return view("cartitems");
    }
    public function removeproduct($id)
    {
        Cart::remove($id);
        return back()->with("success", "item has been deleted");
    }
    public function addproduct(Request $req)
    {
        $data = "";
        $name = $req->get("name");
        $price = $req->get("price");
        $id = $req->get("id");
        $image = $req->get("image");
        $product = array(
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => 1,
            'attributes' => array('image' => $image),

        );
        $added = Cart::add($product);
        if ($added) {
            $data =  "product has been added ";
        }
        // print_r(Cart::getContent());
        echo $data;
    }
    public function viewitems()
    {
        $data = "";

        $items = Cart::getContent();
        $carts = $items->sort();
        foreach ($carts as $product) {
            $url = asset('images/' . $product->attributes->image);
            $data .= "<div class='card'> <div class='card-body'>";
            $data .= "<img class='img-fluid' src='$url'  alt='Card image'style='max-width:100px' />";
            $data .= '<h5 class="card-title" >' . $product->name . '</h5>';
            $data .= '<p  class="card-text">Rs : ' . $product->price . '</p>';
            $data .= '<p class="card-text">Quantity : ' . $product->quantity . '</p>';
            $data .= "<a class='btn btn-primary' href='removeproduct/" . $product->id . "'>remove</a>";
            $data .= "<input type='button'  data-id='$product->id' value='+' class='btn btn-primary ml-4  increase-quantity' />";
            $data .= "<input type='button' data-id='$product->id' value='-' class='btn btn-danger ml-2 decrease-quantity' />";
            $data .= "</div></div> <br/>";;
        }

        echo $data;
    }
    public function increasequantity(Request $req)
    {
        $id =  $req->get("id");
        Cart::update($id, array(

            'quantity' => 1, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
        ));
    }
    public function decreasequantity(Request $req)
    {
        $id =  $req->get("id");
        Cart::update($id, array(

            'quantity' => -1, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
        ));
    }
    public function stripe()
    {
        return view("stripe");
    }
    public function categories($name)
    {
        $categoriesItem = DB::table('categories_items')
            ->join('products', 'categories_items.product_id', '=', 'products.id')
            ->where('categories_items.category', '=', $name)->get();
        // ->join('country', 'country.country_id', '=', 'state.country_id')
        // ->select('country.country_name', 'state.state_name', 'city.city_name')

        dd($categoriesItem);
    }
    public function stripePost(Request $request)
    {
        $address =  $request->get("address");
        $postalcode = $request->input("postalcode");
        $email = $request->input("email");


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => Cart::getTotal() * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment.",

        ]);

        $insertData =  DB::table('orders')->insert(
            [
                'email' => $email, 'address' => $address, 'amount' => Cart::getTotal(), 'transaction_id' => $request->stripeToken,
                'postal_Code' => $postalcode
            ]

        );
        if ($insertData > 0) {
            Cart::clear();
            Session::flash('success', 'Payment successful!');
            return back();
        }
    }
}
