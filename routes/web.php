<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentAccountController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/course/{course}', [CoursesController::class, 'guestView'])->name('course.guest.view');
Route::get('/course/{course}/buy', [CoursesController::class, 'buy'])->name('course.buy');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // courses get requests
    Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
    Route::get('/courses/create', [CoursesController::class, 'storeForm'])->name('courses.storeForm');
    Route::get('/courses/{course}/view', [CoursesController::class, 'view'])->name('course.view');
    Route::get('/courses/{course}/update', [CoursesController::class, 'updateForm'])->name('course.updateForm');
    Route::get('/courses/{course}/sections', [CoursesController::class, 'sections'])->name('course.sections');
    Route::get('/courses/{course}/sections/create', [CoursesController::class, 'sectionsStoreForm'])->name('courses.sections.storeForm');
    Route::get('/courses/{course}/sections/{section}/update', [CoursesController::class, 'sectionsUpdateForm'])->name('courses.sections.updateForm');
    Route::get('/courses/{course}/lessons', [CoursesController::class, 'lessons'])->name('course.lessons');
    Route::get('/courses/{course}/lessons/create', [CoursesController::class, 'lessonsStoreForm'])->name('courses.lessons.storeForm');
    Route::get('/courses/{course}/lessons/{lesson}/update', [CoursesController::class, 'lessonsUpdateForm'])->name('courses.lessons.updateForm');
    Route::get('/courses/{course}/lessons/{lesson}/view', [CoursesController::class, 'viewLesson'])->name('courses.lessons.view');
    Route::get('/courses/{course}/lessons/{lesson}/start', [CoursesController::class, 'startLesson'])->name('courses.lessons.start');

    // courses post, put and delete requests
    Route::post('/courses/create', [CoursesController::class, 'store'])->name('courses.store');
    Route::put('/courses/{course}/update', [CoursesController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}/delete', [CoursesController::class, 'delete'])->name('courses.delete');
    Route::post('/courses/{course}/sections/create', [CoursesController::class, 'sectionsStore'])->name('courses.sections.store');
    Route::delete('/courses/sections/{section}/delete', [CoursesController::class, 'sectionsDelete'])->name('courses.section.delete');
    Route::put('/courses/{course}/sections/{section}/update', [CoursesController::class, 'sectionsUpdate'])->name('courses.sections.update');
    Route::post('/courses/{course}/lessons/create', [CoursesController::class, 'lessonsStore'])->name('courses.lessons.store');
    Route::put('/courses/{course}/lessons/{lesson}update', [CoursesController::class, 'lessonsUpdate'])->name('courses.lessons.update');
    Route::delete('/courses/lessons/{lesson}/delete', [CoursesController::class, 'lessonsDelete'])->name('courses.lesson.delete');

    // categories get requests
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'storeForm'])->name('categories.storeForm');
    Route::get('/categories/{category}/update', [CategoryController::class, 'updateForm'])->name('categories.updateForm');

    // categories post, put, delete requests
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}/delete', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');

    // student account get requests
    Route::get('/student/account', [StudentAccountController::class, 'index'])->name('student.account');

    // checkout get requests
    Route::get('/course/{course}/checkout', [CoursesController::class, 'checkout'])->name('course.checkout');

    // check post,get,put requests
    Route::post('/course/{course}/checkout', [CoursesController::class, 'storeCheckout'])->name('course.store.checkout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
