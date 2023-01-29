<?php

use App\Http\Livewire\Admin\DashBoard;
use App\Http\Livewire\Admin\Post\AllPost;
use App\Http\Livewire\Admin\Post\TrashPost;
use App\Http\Livewire\Admin\User\AddUser;
use App\Http\Livewire\Admin\User\AllUser;
use App\Http\Livewire\Admin\User\EditUser;
use App\Http\Livewire\Mutual\AddPost;
use App\Http\Livewire\Mutual\DetailsPost;
use App\Http\Livewire\Mutual\EditPost;
use App\Http\Livewire\Mutual\HomeUser;
use App\Http\Livewire\User\DashBordUser;
use App\Http\Livewire\User\EditProfile;
use App\Http\Livewire\User\Profile;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', HomeUser::class)->name('home');
Route::get('/post/{slug}',DetailsPost::class)->name('post.detail');
Route::get('/logout', function () {Auth::logout();return redirect()->route('home');})->name('logout');

Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard',DashBoard::class)->name('dashboard');
    //post route
    Route::get('/admin/allpost',AllPost::class)->name('all-post');
    Route::get('/addpost', AddPost::class)->name('add-post');
    Route::get('/editpost/{post_id}',EditPost::class)->name('admin.edit_post');
    //user route
    Route::get('/admin/alluser',AllUser::class)->name('all-user');
    Route::get('/admin/adduser',AddUser::class)->name('add-user');
    Route::get('/admin/edituser/{user_id}',EditUser::class)->name('edit-user');
    //trash route
    Route::get('/admin/trashpost',TrashPost::class)->name('trash-post');
});

//user routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/addpost', AddPost::class)->name('add-post');
    Route::get('/editpost/{post_id}',EditPost::class)->name('admin.edit_post');
    //user route
    Route::get('/user/dashboard',DashBordUser::class)->name('dashboard.user');
    Route::get('/admin/trashpost',TrashPost::class)->name('trash-post');
    Route::get('/user/profile/{user_id}',Profile::class)->name('profile-user');
    Route::get('/user/editprofile/{user_id}',EditProfile::class)->name('edit-profile-user');
});


