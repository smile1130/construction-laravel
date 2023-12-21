<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    ConstructionController,
    QuoteController
};

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

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerGet'])->name('register');
    Route::get('/login', [AuthController::class, 'loginGet'])->name('login');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('post.register');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('post.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/fetch-address/{postalCode}', [UserController::class, 'fetchAddress'])->name('fetch.address');
    Route::get('/fetch-construction/{id}', [ConstructionController::class, 'fetchConstruction'])->name('fetch.construction');
    Route::get('/fetch-quote/{id}', [QuoteController::class, 'fetchQuote'])->name('fetch.quote');
    Route::get('/remove/construction/{id}', [ConstructionController::class, 'removeConstruction'])->name('remove.construction');
    Route::get('/remove/quote/{id}', [QuoteController::class, 'removeQuote'])->name('remove.quote');
    Route::get('/fetch-category/{id}', [QuoteController::class, 'fetchCategory'])->name('fetch.category');
    Route::get('create/newquote/{name}', [QuoteController::class, 'newQuote'])->name('newquote');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [UserController::class, 'viewDashboard'])->name('dashboard');
    Route::get('/quote', [UserController::class, 'viewQuote'])->name('quote');
    Route::post('/new/construction', [ConstructionController::class, 'newConstructionPost'])->name('post.newconstruction');
    Route::post('/new/quote', [QuoteController::class, 'newQuotePost'])->name('post.newquote');
    Route::post('/add/items', [QuoteController::class, 'addItemsPost'])->name('post.additems');
});