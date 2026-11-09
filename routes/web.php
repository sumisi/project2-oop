<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/arrya', [MainController::class, 'showArray'])-> name('arrya');

Route::get('/arrya/shuffle',[MainController::class, 'shuffleArray'])->name('arrya.shuffle');

Route::get('/arrya/sort',[MainController::class, 'sortArray'])->name('arrya.sort');

Route::get('/arrya/filter',[MainController::class, 'filterArray'])->name('arrya.filter');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');

Route::get('/reports/create', function(){
    return view('report.create');})->name('reports.create');

Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');

Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');

Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');

require __DIR__.'/auth.php';
