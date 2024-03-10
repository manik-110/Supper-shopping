<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\editController;
use App\Http\Controllers\FrontendControllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/about',[FrontendControllers::class, 'about'])->name('about.');




Route::get('/', function (){
    return view('welcome');
});








Route::get('/dashboard', function () {
    return view('layouts.admin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Frontend controller

//edit profile
Route::get('edit/profile', [editController::class, 'edit_profile'])->name('edit.profile');
Route::post('update/profile', [editController::class, 'update_profile'])->name('update.profile');
Route::post('update/password', [UserController::class, 'update_password'])->name('update.password');
Route::post('update/photo', [UserController::class, 'update_photo'])->name('update.photo');



// User List

Route::get('user/list', [UserController::class, 'UserList'])->name('user.list');
Route::get('user/delete/{id}', [UserController::class, 'Userdelete'])->name('user.delete');

//Category list

Route::get('add/category', [ CategoryController::class, 'add_category'])->name('add.category');
Route::post('category/store', [ CategoryController::class, 'category_store'])->name('category.store');
Route::get('category/delete/{id}', [ CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('category/edit/{id}', [ CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('category/update/{id}', [ CategoryController::class, 'category_update'])->name('category.update');
Route::get('category/trash', [ CategoryController::class, 'category_trash'])->name('category.trash');
Route::get('category/recovery/{id}', [ CategoryController::class, 'category_recovery'])->name('category.recovery');
Route::get('category/forced/deleted/{id}', [ CategoryController::class, 'category_forced_deleted'])->name('category.forced.deleted');

