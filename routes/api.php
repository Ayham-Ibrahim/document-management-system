<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\NotificatonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::middleware('auth')->group(function () {

    Route::apiResource('tags', TagController::class);

    ##### comment routes #####
    Route::get('/comments',[CommentController::class, 'index']);
    Route::get('/comment/{comment}',[CommentController::class, 'show']);
    Route::post('/add-comment/{document}',[CommentController::class, 'store']); 
    Route::put('/update-comment/{comment}',[CommentController::class, 'update'])->middleware('update_comment');
    Route::delete('/delete-comment/{comment}',[CommentController::class, 'destroy'])->middleware('delete_comment');
    ### End comment routes ###

    ##### document routes #####
    Route::get('/documents',[DocumentController::class, 'index']);
    Route::get('/document/{document}',[DocumentController::class, 'show']);
    Route::post('/add-document',[DocumentController::class, 'store']); 
    Route::put('/update-document/{document}',[DocumentController::class, 'update'])->middleware('update_document');
    Route::delete('/delete-document/{document}',[DocumentController::class, 'destroy'])->middleware('delete_document');
    ### End document routes ###
    
    Route::post('/follow-category/{category}',[CategoryController::class, 'followCategory']);
    Route::post('/document/{document}/toggle-like', [DocumentController::class, 'toggleLike']);
    Route::get('/download-document/{document}',[DocumentController::class, 'download']);

        // Notification
        Route::get('/notifications', [NotificatonController::class, 'showUnreadNotification']);
        Route::put('/read_notification/{notification}', [NotificatonController::class, 'markNotificationAsRead']);
    
});

Route::middleware(['auth', 'admin'])->group(function () {
    ##### category routes #####
    Route::get('/categories',[CategoryController::class, 'index']);
    Route::get('/category/{category}',[CategoryController::class, 'show']);
    Route::post('/add-category',[CategoryController::class, 'store']);
    Route::put('/update-category/{category}',[CategoryController::class, 'update']);
    Route::delete('/delete-category/{category}',[CategoryController::class, 'destroy']);
    ### End category routes ###
});




















// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
