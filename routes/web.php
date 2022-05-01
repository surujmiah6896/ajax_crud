<?php

use App\Http\Controllers\AjaxcrudController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('ajaxcrud',AjaxcrudController::class);
Route::get('/student/all',[AjaxcrudController::class, 'studentall'])->name('student.all');
Route::post('/add/student',[AjaxcrudController::class, 'addstudent'])->name('add.student');
Route::get('/edit/student/{id}',[AjaxcrudController::class, 'editstudent'])->name('edit.student');
Route::post('/update/student/{id}',[AjaxcrudController::class, 'updatestudent'])->name('update.student');
Route::get('/delete/student/{id}',[AjaxcrudController::class, 'deletestudent'])->name('delete.student');
