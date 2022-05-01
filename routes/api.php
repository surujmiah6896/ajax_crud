<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// get all info api
Route::get('/get/alldata',[ApiController::class,'getalldata']);
//single and multiple get student info api
Route::get('/student/info/{id?}',[ApiController::class, 'studentinfo']);
//single student add api
Route::Post('/add/student',[ApiController::class, 'addstudent']);
//multiple student add api
Route::Post('/add-multiple/student',[ApiController::class, 'addmultiplestudent']);
//put api student update
Route::put('/update/student-details/{id}', [ApiController::class, 'updatestudentdetails']);
//put api for update single record
Route::patch('/update/student-single_record/{id}', [ApiController::class, 'updatestudentsinglerecord']);
//delete api for delete single student
Route::delete('/delete/single_student/{id}', [ApiController::class, 'deletesinglestudent']);
//delete api for delete single student with json
Route::delete('/delete/single_student-with-json', [ApiController::class, 'deletesinglestudentwithjson']);
//delete api for delete multiple student
Route::delete('/delete/multiple_student/{ids}', [ApiController::class, 'deletemultiplestudent']);
//delete api for delete single student with json and vaidation with header token
Route::delete('/delete/multiple_student-with-json', [ApiController::class, 'deletemultiplestudentwithjson']);

//register api with passport token
Route::post('/register-api-using-passport',[ApiController::class,'registerAPIUsingPassport']);

//login api with passport token
Route::post('/login-api-using-passport', [ApiController::class, 'loginAPIUsingPassport']);
