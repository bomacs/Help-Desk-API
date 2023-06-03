<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\Ticket_typeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// PROTECTED ROUTES
Route::middleware(['auth:api', 'role'])->group(function() {
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('tickets', TicketController::class);
    Route::apiResource('ticket_types', Ticket_typeController::class);
    // Users Index
    Route::middleware(['scope:Admin'])->get('/users', [UserController::class, 'index']);
    // Users Show
    Route::middleware(['scope:Agent'])->get('/users/{user}', [UserController::class, 'show']);
    Route::middleware(['scope:Admin'])->put('/users/{user}', [UserController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


