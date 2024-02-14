<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerminoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    Route::get('/',[TerminoController::class,'index'])->name('home');//para que nos lleve al inicio del crud home
});

//formas de aceder a las urls de una en una
/*Route::get('/termino', function () {
    return view('termino.index');
});
Route::get('/termino/create',[TerminoController::class,'create']);*/

//forma para aceder para todas las urls de un golpe
Route::resource('termino',TerminoController::class);

Auth::routes();

Route::get('/home', [TerminoController::class, 'index'])->name('home');//al escribir home nos lleva al inicio del crud
