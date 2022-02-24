<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\StdNoteController;
use App\Http\Controllers\StudentController;
use App\Models\Note;
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
Route::get('/', function () {
    return view('index');
});

// Route::get('/dashboard', function () {

//     return view('index');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*--------------- ADMIN LOGIN Route---------*/
 Route::prefix('admin')->group(function(){

    Route::get('/login',[AdminController::class,'Index'])->name('admin_login');
    Route::post('/login/owner',[AdminController::class,'Login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class,'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::post('/Logout',[AdminController::class,'AdminLogout'])->name('admin.logout')->middleware('admin');

    /*--------------- File Upload Route---------*/
    Route::get('/download/{id}', [NoteController::class, 'Download'])->name('admin.download')->middleware('admin');
    //Route::get('/remove/{id}', [NoteController::class, 'removeFile'])->name('admin.removeFile');
    Route::get('/upload-file', [NoteController::class, 'createForm'])->name('upload-file')->middleware('admin');
    Route::post('/upload-file', [NoteController::class, 'fileUpload'])->name('fileUpload')->middleware('admin');
    Route::get('/notes', [NoteController::class, 'ViewNote'])->name('myNote')->middleware('admin');


    /*--------------- File Upload Route ute ENDS---------*/


 });
/*--------------- ADMIN LOGIN Route ENDS---------*/

/*--------------- STUDENT LOGIN Route---------*/
Route::prefix('student')->group(function(){

    Route::get('/login',[StudentController::class,'Index'])->name('student_login');
    Route::post('/login/owner',[StudentController::class,'Login'])->name('student.login');
    Route::get('/dashboard',[StudentController::class,'Dashboard'])->name('student.dashboard')->middleware('student');
    Route::post('/Logout',[StudentController::class,'StudentLogout'])->name('student.logout')->middleware('student');
    Route::get('/Register',[StudentController::class,'StudentRegister'])->name('student.register');
    Route::post('/Register/create',[StudentController::class,'StdRegisterCreate'])->name('student.registerCreate');

    /*--------------- File Upload Route---------*/
     Route::get('/download/{id}', [StdNoteController::class, 'StdDownload'])->name('StdAdmin.download')->middleware('student');
     Route::get('/upload-file', [StdNoteController::class, 'StdCreateForm'])->name('StdUpload-file')->middleware('student');
     Route::post('/upload-file', [StdNoteController::class, 'StdFileUpload'])->name('StdFileUpload')->middleware('student');
     Route::get('/notes', [StdNoteController::class, 'StdViewNote'])->name('studentNote')->middleware('student');


    /*--------------- File Upload Route ute ENDS---------*/


 });
/*--------------- Student LOGIN Route ENDS---------*/



