<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/sharedlinks', function () {
    return view('sharedlinks');
})->name('sharedlinks');

Route::get('savedlinks', [LinkController::class, 'index'])->name('savedlinks');

Route::get('/createlink', [LinkController::class, 'create'])->name('create');
Route::get('/editlink/{id}', [LinkController::class, 'edit'])->name('edit');
Route::get('/showlink/{id}', [LinkController::class, 'showPassword'])->name('show');
//Route::get('/showpassword/{id}', [LinkController::class, 'showPassword'])->name('showpassword');
Route::get('/updatelink/{id}', [LinkController::class, 'update'])->name('update');
Route::get('/deletelink/{id}', [LinkController::class, 'destroy'])->name('delete');
Route::get('/delete/{id}', [LinkController::class, 'delete'])->name('deletelink');
Route::post('/storelink', [LinkController::class, 'store'])->name('storelink');


Route::get('/sharelink/{id}', [LinkController::class, 'share'])->name('share');

//Route::resource(‘links’, LinkController::class);

require __DIR__.'/auth.php';
