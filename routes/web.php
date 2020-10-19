<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ProductController@index');
// Cart::add(455, 'Sample Item', 100.99, 2, array());
// Cart::update("455", array(
//     'quantity' => 9, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
//   ));
// $saleCondition = new \Darryldecode\Cart\CartCondition(array(
//     'name' => 'SALE 5%',
//     'type' => 'tax',
//     'value' => '-5%',
// ));

// $product = array(
//     'id' => "466",
//     'name' => 'Sample Item 1',
//     'price' => 100,
//     'quantity' => 1,
//     'attributes' => array(),
//     'conditions' => $saleCondition
// );

// finally add the product on the cart
// Cart::add($product);


// Route::get('/get', function () {
//     // return  Cart::getSubTotal();
// //    return  Cart::getTotal();
//     // return Cart::getContent()->count();
//     return Cart::getContent();
//     // return Cart::get("466");
// //    return  Cart::getTotalQuantity();

// });

Route::get("/createproduct", 'ProductController@createproduct');
Route::post('/upload', 'ProductController@uploadproduct')->name('createblog');
Route::get('/viewproduct/{id}', 'ProductController@viewproduct')->name('viewproduct');
Route::post('/addproduct', 'ProductController@addproduct')->name('addproduct');
Route::get('/viewcart', 'ProductController@viewcart')->name('viewcart');
Route::get('/removeproduct/{id}', 'ProductController@removeproduct')->name('removeproduct');
Route::get('/viewitems', 'ProductController@viewitems')->name('viewitems');
Route::post('/increasequantity', 'ProductController@increasequantity')->name('increasequantity');
Route::post('/decreasequantity', 'ProductController@decreasequantity')->name('decreasequantity');
Route::post('stripe', 'ProductController@stripePost')->name('stripe.post');
Route::get('/stripe', 'ProductController@stripe')->name('stripe');
Route::get('/categories/{name}', 'ProductController@categories')->name('categories');
