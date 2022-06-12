<?php

use App\Http\Controllers\Admin\FormController as AdminFormController;
use App\Http\Controllers\FormResponseController;
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
    return redirect()->route('login');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';

Route::prefix('admin/form')->middleware(['auth','admin'])->group(function(){

    Route::get('/' , [AdminFormController::class , 'index'])->name('form');
    Route::get('/create' , [AdminFormController::class , 'create'])->name('form.create');
    Route::post('/submit',[AdminFormController::class , 'store'])->name('form.create.submit');
    Route::delete('/{form}/delete',[AdminFormController::class,'destroy'])->name('form.delete');
    Route::get('/{id}/restore',[AdminFormController::class,'restore'])->name('form.restore');
    Route::get('/{id}/force/delete',[AdminFormController::class,'destroyPermanently'])->name('form.force.delete');
    
    Route::get('/{form}/response',[AdminFormController::class,'showResponses'])->name('form.response.show');

});

Route::get('/form/{form}',[FormResponseController::class,'index'])->name('form.show');
Route::post('/form/{form}',[FormResponseController::class,'store'])->name('form.submit');

