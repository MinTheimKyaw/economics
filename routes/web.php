<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\OrderController;
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
// public site

Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome')
    ->middleware('guest');
    

Route::get('/welcome', [WelcomeController::class, 'index'])
    ->name('welcome')
    ->middleware('guest');

Route::get('/publiccategories/{categories}/subcategories', [WelcomeController::class, 'publicsubcategories'])
    ->name('publicsubcategories')
    ->middleware('guest');


Route::get('/publicsubcategories/{subcategories}/product', [WelcomeController::class, 'publicproduct'])
    ->name('publicproduct')
    ->middleware('guest');

Route::get('/publicproduct/{product}/detail', [WelcomeController::class, 'productdetail'])
    ->name('productdetail')
    ->middleware('guest');


Route::get('/orderhistory', [WelcomeController::class, 'orderhistory'])
    ->name('orderhistory')
    ->middleware('guest');

Route::post('orderhistory', [WelcomeController::class, 'store'])
    ->name('orderhistory.store')
    ->middleware('guest');


Route::get('/orderhistorysuccess', [WelcomeController::class, 'orderhistorysuccess'])
    ->name('orderhistorysuccess')
    ->middleware('guest');

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Categories

Route::get('categories', [CategoriesController::class, 'index'])
    ->name('categories')
    ->middleware('auth');

Route::get('categories/create', [CategoriesController::class, 'create'])
    ->name('categories.create')
    ->middleware('auth');

Route::post('categories', [CategoriesController::class, 'store'])
    ->name('categories.store')
    ->middleware('auth');

Route::put('categories/{categories}', [CategoriesController::class, 'update'])
    ->name('categories.update')
    ->middleware('auth');
    
Route::get('categories/{categories}/edit', [CategoriesController::class, 'edit'])
->name('categories.edit')
->middleware('auth');


Route::delete('categories/{categories}', [CategoriesController::class, 'destroy'])
    ->name('categories.destroy')
    ->middleware('auth');

// Sub Categories
Route::get('subcategories', [SubcategoriesController::class, 'index'])
    ->name('subcategories')
    ->middleware('auth');

Route::get('subcategories/create', [SubcategoriesController::class, 'create'])
    ->name('subcategories.create')
    ->middleware('auth');


Route::post('subcategories', [SubcategoriesController::class, 'store'])
    ->name('subcategories.store')
    ->middleware('auth');

Route::put('subcategories/{subcategories}', [SubcategoriesController::class, 'update'])
    ->name('subcategories.update')
    ->middleware('auth');

Route::get('subcategories/{subcategories}/edit', [SubcategoriesController::class, 'edit'])
    ->name('subcategories.edit')
    ->middleware('auth');


Route::delete('subcategories/{subcategories}', [SubcategoriesController::class, 'destroy'])
    ->name('subcategories.destroy')
    ->middleware('auth');


//Product
Route::get('product', [ProductController::class, 'index'])
    ->name('product')
    ->middleware('auth');

Route::get('product/create', [ProductController::class, 'create'])
    ->name('product.create')
    ->middleware('auth');

Route::post('product', [ProductController::class, 'store'])
    ->name('product.store')
    ->middleware('auth');

Route::get('product/{product}/edit', [ProductController::class, 'edit'])
    ->name('product.edit')
    ->middleware('auth');

Route::put('product/{product}', [ProductController::class, 'update'])
    ->name('product.update')
    ->middleware('auth');

Route::delete('product/{product}', [ProductController::class, 'destroy'])
    ->name('product.destroy')
    ->middleware('auth');

//order
Route::get('order', [OrderController::class, 'index'])
    ->name('order')
    ->middleware('auth');

Route::put('order/{order}', [OrderController::class, 'changestatus'])
    ->name('order.changestatus')
    ->middleware('auth');

Route::get('order/{order}/show', [OrderController::class, 'show'])
    ->name('order.show')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');
