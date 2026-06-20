<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Businesses
Route::get('/businesses', [BusinessController::class, 'index'])->name('businesses.index');
Route::get('/businesses/{slug}', [BusinessController::class, 'show'])->name('businesses.show');

// Jobs
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/jobs/{slug}/apply', [JobController::class, 'apply'])->name('jobs.apply')->middleware('auth');

// Auth (placeholder)
Route::get('/login', fn() => redirect('/')->with('info', 'صفحة تسجيل الدخول قيد الإعداد'))->name('login');
Route::get('/register', fn() => redirect('/')->with('info', 'صفحة إنشاء الحساب قيد الإعداد'))->name('register');
Route::get('/dashboard', fn() => redirect('/')->with('info', 'لوحة التحكم قيد الإعداد'))->name('dashboard');
