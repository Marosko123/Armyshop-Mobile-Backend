<?php

use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\LoginRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BasketsController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\LikedProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UsersController::class, 'get']);
Route::get('users/{id}', [UsersController::class, 'getById']);
Route::post('users', [UsersController::class, 'add']);
Route::put('users/{id}/update', [UsersController::class, 'update']);
Route::delete('users/{id}/delete', [UsersController::class, 'delete']);

Route::post('login', [LoginRegisterController::class, 'login']);
Route::post('register', [LoginRegisterController::class, 'register']);



// CATEGORIES

// get all categories
Route::get('categories', [CategoryController::class, 'get']);

// get category by id
Route::get('categories/id/{id}', [CategoryController::class, 'getById']);

// get category by name
Route::get('categories/name/{name}', [CategoryController::class, 'getByName']);

// create categories
Route::get('categories/create', [CategoryController::class, 'add']);


// SUBCATEGORIES


// get subcategories of category
Route::get('category/{category_id}/subcategories', [SubcategoryController::class, 'getByCategory']);

// get subcategory of category by name
Route::get('category/{category_id}/subcategories/name/{name}', [SubcategoryController::class, 'getById']);

// create subcategories for category
Route::get('category/{category_id}/subcategories/create', [SubcategoryController::class, 'add']);

// create all subcategories
Route::get('category/subcategories/create', [SubcategoryController::class, 'addAll']);


// BASKETS

// get basket for user
Route::get('user/{user_id}/basket', [BasketsController::class, 'getByUserId']);

// add item to basket
Route::post('user/{user_id}/basket/add/{product_id}', [BasketsController::class, 'add']);

// delete item from basket
Route::delete('user/{user_id}/basket/delete/{product_id}', [BasketsController::class, 'delete']);

// update amount of certain product
Route::put('user/{user_id}/basket/update/{product_id}/count/{count}', [BasketsController::class, 'update']);


// PRODUCTS

// get all products
Route::get('products', [ProductController::class, 'get']);

// get products from category
Route::get('products/{id}/categories', [ProductController::class, 'getFromCategory']);

// get products from subcategory
Route::get('products/{subcategory_id}/subcategory', [ProductController::class, 'getFromSubcategory']);

// create a product
// sample creation JSON:
// {
//     "name": "product name",
//     "price": 9.99,
//     "description": "product description",
//     "image_url": "https://example.com/image.jpg",
//     "subcategory_id": 1,
//     "license_needed": true
// }
Route::post('products/create', [ProductController::class, 'add']);

// delete a product
Route::delete('products/delete/product/{product_id}', [ProductController::class, 'remove']);

// delete all products
Route::delete('products/delete/all', [ProductController::class, 'removeAll']);

// LIKED PRODUCTS

// get Liked products
Route::get('user/{user_id}/liked', [LikedProductController::class, 'get']);

// add to liked products
Route::post('user/{user_id}/liked/add/{product_id}', [LikedProductController::class, 'add']);

// remove from liked products
Route::delete('user/{user_id}/liked/remove/{product_id}', [LikedProductController::class, 'delete']);

// get most popular products
Route::get('products/popular/{amount}', [LikedProductController::class, 'getMostPopular']);