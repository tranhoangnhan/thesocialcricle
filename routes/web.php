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
use App\Livewire\Clients\Posts\PostController as Post;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowAddFriendsController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;

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
    Route::get('/create-course', [EducationController::class, 'courses_register'])->name('courses_register');
    Route::get('/create-course/{slug}', [EducationController::class, 'courses_register_content'])->name('courses_register_content');
    Route::get('/courses', [EducationController::class, 'index'])->name('Courses');
    Route::get('/courses/{slug}', [EducationController::class, 'courses_intro'])->name('courses_intro');
    Route::get('/profile/{id}', [ProfileController::class, 'showInfo'])->name('profile_render');
    Route::get('/courses/{slug}/enroll', [VideoController::class, 'index'])->name('video');
    Route::get('/courses/{slug}/enroll/{video}', [VideoController::class, 'index'])->name('video');

});

// Route::get('/test', function(){
//     return 'test';
// })->middleware('auth.basic');

Route::get('/reset-password/{key}', [AuthController::class,'reset_password'])->name('reset_password');
Route::get('/forgotpassword', [AuthController::class, 'forgot'])->name('forgotpassword');
Route::get('/check', function () {
    dd(request());
});
Route::get('/test', [PostController::class, 'index']);



Route::get('/son', [UserController::class, 'addPermission']);

Auth::routes();


// <div class="relative" uk-slider="finite: true">

// <div class="container px-1 py-3 row gy-2">
//     <div class="card col-3">
//         <div class="card-media h-28">
//             <div class="card-media-overly"></div>
//             <img src="{{asset('clients/assets/images/group/group-cover-1.jpg')}}" alt="">
//             <div class="absolute bg-red-100 font-semibold px-2.5 py-1 rounded-lg text-red-500 text-xs top-2.5 left-2.5"> Trend </div>
//         </div>
//         <div class="card-body">
//             <a href="timeline-group.html" class="font-semibold text-lg truncate"> Graphic Design </a>
//             <div class="flex items-center flex-wrap space-x-1 mt-1 text-sm text-gray-500 capitalize">
//                 <a href="#"> <span> 232k members </span> </a>
//                 <a href="#"> <span> 1.7k post a day </span> </a>
//             </div>
//             <div class="flex mt-3.5 space-x-2">
//                 <div class="flex items-center -space-x-2 -mt-1">
//                     <img alt="Image placeholder" src="{{asset('clients/assets/images/avatars/avatar-6.jpg')}}" class="border-2 border-white rounded-full w-7">
//                     <img alt="Image placeholder" src="{{asset('clients/assets/images/avatars/avatar-5.jpg')}}" class="border-2 border-white rounded-full w-7">
//                 </div>
//                 <div class="flex-1 leading-5 text-sm">
//                     <div> <strong>Johnson</strong> and 5 freind are members </div>
//                 </div>
//             </div>
//             <div class="flex mt-3.5 space-x-2 text-sm font-medium">
//                 <a href="#" class="bg-blue-600 flex flex-1 h-8 items-center justify-center rounded-md text-white capitalize">
//                     Join
//                 </a>
//                 <a href="#" class="bg-gray-200 flex flex-1 h-8 items-center justify-center rounded-md capitalize">
//                     View
//                 </a>
//             </div>
//         </div>
//     </div>


// </div>

// </div>
