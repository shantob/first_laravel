<?php

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



Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]); 


Route::get('/', 'forntend\HomeController@index')->name('home');

Route::get('about-us', 'forntend\AboutController@index')->name('about');

Route::get('contact-us', 'forntend\ContactController@index')->name('contact');

Route::get('blog', 'forntend\BlogController@index')->name('blog.index');

Route::get('blog/{slug}', 'forntend\BlogController@show')->name('blog.show');

Route::post('comment','forntend\CommentController@store')->name('comment.store');

Route::get('category/{slug}','forntend\CategoryController@show')->name('category.show');


Route::prefix('admin')->group(function () {

	Route::get('/', 'Backend\HomeController@index')->name('admin.home');

	Route::resource('category','Backend\CategoryController',['names'=>'admin.category']);

  Route::resource('blog','Backend\BlogController',['names'=>'admin.blog']);

  Route::get('comments','Backend\CommentController@index')->name('admin.comment.index');
  Route::get('comments/{id}','Backend\CommentController@show')->name('admin.comment.show');

  Route::post('comment/store','Backend\CommentController@store')->name('admin.comment.store');
  Route::delete('comment/{id}','Backend\CommentController@destroy')->name('admin.comment.destroy');
  Route::get('notifications','Backend\NotificationController@index')->name('admin.notification.index');
  Route::get('notifications/{id}','Backend\NotificationController@show')->name('admin.notification.show');

});