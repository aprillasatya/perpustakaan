<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\BookController as ControllersBookController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login', ['prefix' => Route::current()->getPrefix()]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
  //All the admin routes will be defined here...
  Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login',[LoginController::class, 'login'])->name('login');
  Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
  // Route::get('/addadmin', [LoginController::class, 'addAdmin']);

  Route::group(['middleware' => ['auth:admin']], function(){
    Route::get('/admin-dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/admin-anggota', [MemberController::class, 'index'])->name('form-member');
    Route::get('/admin-buku', [BookController::class, 'index'])->name('form-book');
    Route::post('/admin-create-buku', [BookController::class, 'store'])->name('store-book');
    Route::get('/admin-list-buku', [BookController::class, 'listBook'])->name('list-book');
    Route::get('/admin-peminjaman-buku', [BookController::class, 'bookBorrowing'])->name('borrowing-book');
    Route::get('/admin-list-peminjaman-buku', [BookController::class, 'bookBorrowingList'])->name('list-borrowing-book');
  });
});

Route::get('/list-buku', [ControllersBookController::class, 'listBook'])->name('list-book');
Route::get('/buku', [ControllersBookController::class, 'index'])->name('view-book');
Route::post('/peminjaman-buku', [ControllersBookController::class, 'borrowingBook'])->name('borrowing-book');

