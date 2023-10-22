<?php

use App\Http\Controllers\Auth\VeirfyController;
use App\Http\Controllers\ConversationsController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Livewire\Clients\Auth\Forgotpassword;
use App\Livewire\Clients\Auth\ResetPassword;
use App\Livewire\Clients\Auth\Verify;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use App\Livewire\Clients\Auth\Login;
use App\Livewire\Clients\HomeController as HomeC;
use App\Livewire\Clients\PostController as Post;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowAddFriendsController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EducationController;
use App\Livewire\Clients\Education\Create;

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


Route::middleware('checkuser')->group(function () {
    Route::get('/', [Homec::class, 'render'])->name('home');
    Route::get('/verify', [VeirfyController::class, 'index'])->name('verify');
    Route::get('/logout', [Login::class, 'logout'])->name('logout');
    Route::get('/group', [GroupController::class, 'index'])->name('group');
    Route::get('/messages/{id?}', [ConversationsController::class, 'index'])->name('messages');
    Route::post('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/friends',[ShowAddFriendsController::class,'render'])->name('friends');
    Route::post('/create-post', [Post::class, 'createPostIndex'])->name('createPostIndex');
    Route::get('/courses', [EducationController::class, 'index'])->name('Courses');
    Route::get('/courses/{slug}', [EducationController::class, 'courses_intro'])->name('courses_intro');
    Route::get('/courses/video', [EducationController::class, 'courses_video'])->name('courses_video');
});
route::get('/create-course', [EducationController::class, 'create'])->name('create-course');
Route::get('/reset-password/{key}', [AuthController::class,'reset_password'])->name('reset_password');
Route::get('/forgotpassword', [AuthController::class, 'forgot'])->name('forgotpassword');
Route::get('/check', function () {
    dd(request());
});
Route::get('/test', function () {
    return view('test');
});
Route::get('/test2', function () {
    return view('test2');
});
Route::post('/upload', [GoogleDriveController::class, 'index'])->name('upload');




Route::get('/son', [UserController::class, 'addPermission']);
