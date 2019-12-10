<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', "PublicController@index")->name('index');
Route::get('post/{post}','PublicController@singlePost')->name('singlePost');
Route::get('about','PublicController@about')->name('about');
Route::get('contact','PublicController@contact')->name('contact');
Route::post('contact','PublicController@contactPost')->name('contactPost');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::prefix('user')->group(function (){
    Route::post('new-comment','UserController@newComment')->name('userNewComment');
    Route::get('dashboard','UserController@dashboard')->name('userDashboard');

    Route::get('comments',"UserController@comments")->name('userComments');
    Route::post('comment/{id}/delete','UserController@deleteComment')->name('userDeleteComment');

    Route::get('profile','userController@profile')->name('userProfile');
    Route::post('profile','userController@profilePostChange')->name('userProfilePostChange');

});

Route::prefix('author')->group(function (){
    Route::get('dashboard','AuthorController@dashboard')->name('authorDashboard');

    Route::get('posts','AuthorController@posts')->name('authorPosts');
    Route::get('posts/new', 'AuthorController@newPost')->name('authorNewPost');
    Route::post('posts/new', 'AuthorController@createPost')->name('authorCreatePost');
    Route::get('post/{id}/edit','AuthorController@editPost')->name('authorEditPost');
    Route::post('post/{id}/edit','AuthorController@postEditPost')->name('authorPostEditPost');
    Route::post('post/{id}/delete','AuthorController@deletePost')->name('authorPostDelete');

    Route::get('comments',"AuthorController@comments")->name('authorComments');
});

Route::prefix('admin')->group(function (){
    Route::get('dashboard','AdminController@dashboard')->name('adminDashboard');

    Route::get('posts','AdminController@posts')->name('adminPosts');
    Route::get('post/{id}/edit','AdminController@editPost')->name('adminEditPost');
    Route::post('post/{id}/edit','AdminController@postEditPost')->name('adminPostEditPost');
    Route::post('post/{id}/delete','AdminController@deletePost')->name('adminPostDelete');

    Route::get('comments','AdminController@comments')->name('adminComments');
    Route::post('comment/{id}/delete','AdminController@commentDelete')->name('adminCommentDelete');

    Route::get('users','AdminController@users')->name('adminUsers');
    Route::post('users/{id}/delete','AdminController@usersDelete')->name('adminUsersDelete');
    Route::get('users/{id}/edit','AdminController@editUser')->name('adminEditUser');
    Route::post('users/{id}/edit','AdminController@userEditUser')->name('adminUserEditUser');

});
