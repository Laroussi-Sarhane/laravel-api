<?php

use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TecnologyController;
use App\Http\Controllers\Admin\TypeController;




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
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');


Route::get('/',[PageController::class,'index'])->name('home');




Route::middleware(['auth', 'verified'])
                ->prefix('admin')
                ->name('admin.')
                ->group(function (){
                    // qui inserisco le rotte delle crud
                    Route::get('/', [DashboardController::class, 'index'])->name('home');

                    Route::resource('project',ProjectController::class);
                    Route::resource('tecnology',TecnologyController::class);
                    Route::resource('type',TypeController::class);

                });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
