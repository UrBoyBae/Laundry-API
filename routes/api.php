<?php

use App\Http\Controllers\DetailTransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TransactionController;
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
Route::get('/packages', [PackageController::class, 'getPackage']);
Route::post('/packages', [PackageController::class, 'addPackage']);
Route::get('/packages/{id}', [PackageController::class, 'getDetailPackage']);
Route::put('/packages/{id}', [PackageController::class, 'editPackage']);
Route::delete('/packages/{id}', [PackageController::class, 'deletePackage']);

// Request Transactions
Route::get('/transactions', [TransactionController::class, 'getTransaction']);
Route::post('/transactions', [TransactionController::class, 'addTransaction']);
Route::get('/transactions/{id}', [TransactionController::class, 'getDetailTransaction']);
Route::put('/transactions/{id}', [TransactionController::class, 'editTransaction']);
Route::delete('/transactions/{id}', [TransactionController::class, 'deleteTransaction']);

// Request Detail Transactions
Route::get('/detailTransaction/{id}', [DetailTransactionController::class, 'getDetail']);