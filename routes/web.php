<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CategoryController;
use Inertia\Inertia;

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
    return Inertia::render('HomeView', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
    Route::get('/courses/create', [CoursesController::class, 'storeForm'])->name('courses.storeForm');
    Route::post('/courses/create', [CoursesController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/view', [CoursesController::class, 'view'])->name('course.view');

    // categories get requests
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'storeForm'])->name('categories.storeForm');
    Route::get('/categories/{category}/update', [CategoryController::class, 'updateForm'])->name('categories.updateForm');

    // categories post, put, delete requests
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}/delete', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
