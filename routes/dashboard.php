<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\AreaController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\BusinessController;
use App\Http\Controllers\Dashboard\BusinessImageController;
use App\Http\Controllers\Dashboard\BusinessServiceController;
use App\Http\Controllers\Dashboard\BusinessWorkingHourController;
use App\Http\Controllers\Dashboard\ReviewController;
// use App\Http\Controllers\Dashboard\JobListingController;
use App\Http\Controllers\Dashboard\PlanController;
use App\Http\Controllers\Dashboard\SubscriptionController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\SearchLogController;

Route::prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {

        Route::resources([
            'area' => AreaController::class,
            'category' => CategoryController::class,
            'business' => BusinessController::class,
            'business-image' => BusinessImageController::class,
            'business-service' => BusinessServiceController::class,
            'business-working-hour' => BusinessWorkingHourController::class,
            'review' => ReviewController::class,
            // 'job-listing' => JobListingController::class,
            'plan' => PlanController::class,
            'subscription' => SubscriptionController::class,
            'report' => ReportController::class,
        ]);

        Route::resource('search-log', SearchLogController::class)
            ->only(['index', 'destroy']);
    });