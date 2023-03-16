<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\UserController;

// Request Login
Route::post('/login', [LoginController::class, 'login']);

// Request Outlet
Route::get('/outlets', [OutletController::class, 'getOutlet']);
Route::post('/outlets', [OutletController::class, 'addOutlet']);
Route::get('/outlets/{id}', [OutletController::class, 'getDetailOutlet']);
Route::put('/outlets/{id}', [OutletController::class, 'editOutlet']);
Route::delete('/outlets/{id}', [OutletController::class, 'deleteOutlet']);

// Request Member
Route::get('/members', [MemberController::class, 'getMember']);
Route::post('/members', [MemberController::class, 'addMember']);
Route::get('/members/{id}', [MemberController::class, 'getDetailMember']);
Route::put('/members/{id}', [MemberController::class, 'editMember']);
Route::delete('/members/{id}', [MemberController::class, 'deleteMember']);

// Request Users
Route::get('/users', [UserController::class, 'getUser']);
Route::post('/users', [UserController::class, 'addUser']);
Route::get('/users/{id}', [UserController::class, 'getDetailUser']);
Route::put('/users/{id}', [UserController::class, 'editUser']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

// Request Package
Route::get('/packages', [UserController::class, 'getUser']);
Route::post('/packages', [UserController::class, 'addUser']);
Route::get('/packages/{id}', [UserController::class, 'getDetailUser']);
Route::put('/packages/{id}', [UserController::class, 'editUser']);
Route::delete('/packages/{id}', [UserController::class, 'deleteUser']);