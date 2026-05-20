<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Show Registration Page
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Submit Register
Route::post('/register', [AuthController::class, 'register']);

// Show Login Page
Route::get('/login', [AuthController::class, 'showLogin'])->name('signin');

// Execute Login Page
Route::post('/login', [AuthController::class, 'login']);

// Display dashboard page
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

// Execute Logout Page
Route::get('/logout', [AuthController::class, 'logout']);

// Display User Management Page
Route::get('/users', [UserController::class, 'showUser'])->name('users');

// Execute Add User
Route::post('/users/add', [UserController::class, 'add']);

// Execute Edit User
Route::post('/users/edit/{id}', [UserController::class, 'edit']);

// Execute Delete User
Route::post('/users/delete/{id}', [UserController::class, 'delete']);

// Display Book Library Page
Route::get('/books', [BooksController::class, 'showBooks'])->name('books');

// Execute Add Book
Route::post('/books', [BooksController::class, 'addBook']);

// Execute Delete Book
Route::post('/deleteBook/{id}', [BooksController::class, 'deleteBook']);

// Execute Edit Book
Route::post('/editBook/{id}', [BooksController::class, 'editBook']);

// Execute Add Book
Route::post('/addBook', [BooksController::class, 'addBook']);

// Display Profile Page
Route::get('/profile',  [ProfileController::class, 'showProfile'])->name('profile');

// Execute Update Profile
Route::post('/updateProfile', [ProfileController::class, 'profile']);
