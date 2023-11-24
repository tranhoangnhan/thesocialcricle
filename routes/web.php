<?php

use App\Http\Controllers\admin\FeedbackController;
use App\Http\Controllers\Auth\VeirfyController;
use App\Http\Controllers\ConversationsController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingProfileController;
use App\Http\Controllers\UploadController;
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
use app\Livewire\Clients\Report\Index as Report;
use App\Livewire\Admin\Home as AdminHome;
use App\Http\Controllers\admin\CourseController as AdminCourse;
use App\Http\Controllers\admin\CourseCategoryController as AdminCourseCategory;
use App\Http\Controllers\admin\CourseMountController as AdminCourseMount;
use App\Http\Controllers\admin\FeedbackController as AdminFeedBack;
use App\Http\Controllers\admin\ReportController as AdminReport;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowAddFriendsController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ControlEducationController;



Route::middleware(['checkuser', 'antixss'])->group(function () {
    Route::get('/', [Homec::class, 'render'])->name('home');
    Route::get('/verify', [VeirfyController::class, 'index'])->name('verify');
    Route::get('/logout', [Login::class, 'logout'])->name('logout');
    Route::get('/group', [GroupController::class, 'index'])->name('group');

    Route::get('/messages/{id?}', [ConversationsController::class, 'index'])->name('messages');
    Route::get('/messages/g/{id?}', [ConversationsController::class, 'index'])->name('messagesGroup');
    Route::post('/profile/updateAvatar', [ProfileController::class, 'updateAvatar'])->name('updateAvatar');
    Route::get('/profile/block/{id?}', [ProfileController::class, 'block'])->name('block');
    Route::get('/setting', [SettingProfileController::class, 'index'])->name('setting');
    Route::get('/profile/introduction', [ProfileController::class, 'introduction'])->name('introduction');
    Route::get('/veirfy/2fa', [ProfileController::class, 'verify_2fa'])->name('verify_2fa');
    Route::post('/verify/2fa', [ProfileController::class, 'postVerify_2fa'])->name('postVerify_2fa');

    Route::post('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/friends',[ShowAddFriendsController::class,'render'])->name('friends');
    Route::post('/create-post', [Post::class, 'createPostIndex'])->name('createPostIndex');
    Route::get('/create-course', [EducationController::class, 'courses_register'])->name('courses_register');
    Route::get('/create-course/{slug}', [EducationController::class, 'courses_register_content'])->name('courses_register_content');
    Route::get('/courses', [EducationController::class, 'index'])->name('Courses');
    Route::get('/courses/{slug}', [EducationController::class, 'courses_intro'])->name('courses_intro');
    // Route::get('/profile/{id}', [ProfileController::class, 'showInfo'])->name('profile_render');
    Route::get('/courses/{slug}/enroll', [VideoController::class, 'index'])->name('video');
    Route::post('/courses/{slug}/checkout', [CheckoutController::class,'payment_vnpay__'])->name('payment_vnpay');
    Route::get('/courses/{slug}/checkout/callback', [CheckoutController::class,'insert_db'])->name('payment_vnpaay');

    Route::get('/courses/{slug}/enroll/{video}', [VideoController::class, 'index'])->name('video');
    Route::get('/courses/{slug}/createquiz', [\App\Http\Controllers\CreateQuizController::class, 'index'])->name('create-quiz');
    Route::get('/courses/{slug}/{quiz}/quiz', [\App\Http\Controllers\QuizController::class, 'index'])->name('test-quiz');
    Route::get('/courses/{slug}/control', [ControlEducationController::class, 'index'])->name('control-index');
    Route::get('/courses/{slug}/control/video', [ControlEducationController::class, 'video'])->name('control-video');
    Route::get('/courses/{slug}/control/revenue', [ControlEducationController::class, 'revenue'])->name('control-revenue');
    Route::get('/courses/{slug}/control/member', [ControlEducationController::class, 'member'])->name('control-member');

    Route::get('/courses/{slug}/control/video/edit', [ControlEducationController::class, 'video_edit'])->name('control-video-edit');

    Route::post('/createquestion',[\App\Livewire\Clients\Quiz\CreateQuiz::class, 'storeQuestion'])->name('store-question');
    Route::post('/updatequestion',[\App\Livewire\Clients\Quiz\CreateQuiz::class, 'updateQuestion'])->name('update-question');
//    Route::get('/createquiz', [\App\Http\Controllers\CreateQuizController::class, 'index'])->name('index-createquiz');
//    Route::get('/quiz', [\App\Http\Controllers\QuizController::class, 'index'])->name('index-quiz');
    Route::get('/quiz-thankyou', [\App\Http\Controllers\QuizthankyouController::class, 'index'])->name('thankyou');
    Route::get('/quiz-thankyou/{result}/{get_correct}/{count}', [\App\Livewire\Clients\Quiz\QuizThankyou::class, 'mount'])->name('quiz-thankyou');



    Route::get('/banned', function(){
        return view('errors.adminblock');
    })->name('banned');
});
Route::middleware(['checkadmin'])->group(function () {
    Route::get('/admin/user', [\App\Http\Controllers\admin\AdminUserController::class, 'index'])->name('admin-user.index');
    Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('/admin', [AdminHome::class, 'render'])->name('admin');
    Route::get('/admin/course', [AdminCourse::class, 'Index'])->name('admin.course');
    Route::get('/admin/grossing', [AdminCourseMount::class, 'index'])->name('admin.course-mount');
    Route::get('/admin/course-category', [AdminCourseCategory::class, 'Index'])->name('admin.course-category');
    Route::get('/admin/feedback', [AdminFeedBack::class, 'Index'])->name('admin.feedback');
    Route::get('/admin/report', [AdminReport::class, 'Index'])->name('admin.report');
});

Route::get('/@{id}', [ProfileController::class, 'index'])->where('id', '[0-9A-Za-z]+')->middleware('check.profile')->name('profile');

Route::get('/reset-password/{key}', [AuthController::class, 'reset_password'])->name('reset_password');
Route::get('/forgotpassword', [AuthController::class, 'forgot'])->name('forgotpassword');

//drive
Route::get('/upload', [UploadController::class, 'index'])->name('upload');
Route::post('/upload', [UploadController::class, 'uploadFile'])->name('uploadFile');
Route::post('/upload/delete', [UploadController::class, 'deleteFile'])->name('deleteFileDrive');

//youtube
Route::get('/upload/youtube', [UploadController::class, 'youtube'])->name('uploadYT');
Route::post('/upload/youtube', [UploadController::class, 'uploadYoutube'])->name('uploadYoutube');

Route::get('/auth/google/callback', [UploadController::class, 'oauthCallback'])->name('oauthCallback');
Route::get('/auth/google/unlink/callback', [UploadController::class, 'reauthenticate'])->name('reauthenticate');

Route::get('/log', function () {
    // phpinfo();
})->name('cacheProxy');
// Route::get('proxy/{url?}', [ProxyController::class, 'cacheProxy'])->where('url', '.*')->name('cacheProxy');
Route::get('/proxy', function () {
    try {
        $url = request()->input('url');

        // Sử dụng HTTP client của Laravel để gửi yêu cầu GET tới URL
        $response = Http::get($url);

        // Sao chép các tiêu đề phản hồi từ nguồn gốc
        $headers = $response->headers();
        foreach ($headers as $key => $value) {
            header("$key: $value[0]");
        }

        // Trả về dữ liệu đã tải
        return $response->body();
    } catch (\Exception $e) {
        return response('Error', 400);
    }
})->name('proxy');


Auth::routes();


