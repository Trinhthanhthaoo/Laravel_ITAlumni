<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompetitionsController;
use App\Http\Controllers\MentorInfoController;

// Routes cho Competition
Route::prefix('competitions')->group(function () {
    Route::get('/', [CompetitionsController::class, 'index'])->name('competitions.index');
    
    Route::get('create', [CompetitionsController::class, 'create'])->name('competitions.create');
    
    Route::post('store', [CompetitionsController::class, 'store'])->name('competitions.store');
    
    Route::get('{competition}', [CompetitionsController::class, 'show'])->name('competitions.show');
    
    Route::get('{competition}/edit', [CompetitionsController::class, 'edit'])->name('competitions.edit');
    
    Route::put('{competition}', [CompetitionsController::class, 'update'])->name('competitions.update');
    
    Route::delete('{competition}', [CompetitionsController::class, 'destroy'])->name('competitions.destroy');
});

// Routes cho MentorInfo
Route::prefix('mentor-info')->group(function () {
    Route::get('/', [MentorInfoController::class, 'index'])->name('mentor-info.index');
    
    Route::get('create', [MentorInfoController::class, 'create'])->name('mentor-info.create');

    Route::post('store', [MentorInfoController::class, 'store'])->name('mentor-info.store');
    
    Route::get('{mentorInfo}', [MentorInfoController::class, 'show'])->name('mentor-info.show');
    
    Route::get('{mentorInfo}/edit', [MentorInfoController::class, 'edit'])->name('mentor-info.edit');
    
    Route::put('{mentorInfo}', [MentorInfoController::class, 'update'])->name('mentor-info.update');
    
    Route::delete('{mentorInfo}', [MentorInfoController::class, 'destroy'])->name('mentor-info.destroy');

   
});
use App\Http\Controllers\CommunityDocumentsController;


Route::prefix('community-documents')->group(function () {
    Route::get('/', [CommunityDocumentsController::class, 'index'])->name('community_documents.index');

    Route::post('/', [CommunityDocumentsController::class, 'store'])->name('community_documents.store');

    Route::get('/{document}', [CommunityDocumentsController::class, 'show'])->name('community_documents.show');

    Route::put('/{document}', [CommunityDocumentsController::class, 'update'])->name('community_documents.update');

    Route::delete('/{document}', [CommunityDocumentsController::class, 'destroy'])->name('community_documents.destroy');
});

use App\Http\Controllers\MenteeInfoController;

Route::prefix('mentees')->group(function () {
    Route::get('/', [MenteeInfoController::class, 'index']);
    Route::post('/', [MenteeInfoController::class, 'store']);
    Route::get('/{mentee}', [MenteeInfoController::class, 'show']);
    Route::put('/{mentee}', [MenteeInfoController::class, 'update']);
    Route::delete('/{mentee}', [MenteeInfoController::class, 'destroy']);
});

use App\Http\Controllers\UserController;

Route::get('users', [UserController::class, 'index']); // Lấy danh sách người dùng
Route::post('users', [UserController::class, 'store']); // Tạo người dùng mới
Route::get('users/{id}', [UserController::class, 'show']); // Lấy thông tin người dùng theo ID
Route::put('users/{id}', [UserController::class, 'update']); // Cập nhật thông tin người dùng
Route::delete('users/{id}', [UserController::class, 'destroy']); // Xóa người dùng
