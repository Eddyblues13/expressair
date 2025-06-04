<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;



//home page
Route::get('/', [HomeController::class, 'homepage'])->name('homepage');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/track', [HomeController::class, 'track'])->name('track');
Route::get('/how-to', [HomeController::class, 'how'])->name('how');
Route::get('/destinations', [HomeController::class, 'destinations'])->name('destinations');
Route::match(['get', 'post'], 'package', [HomeController::class, 'viewPackage'])->name('package');



// Public routes
// Route::get('/', [AuthController::class, 'showCodeInput'])->name('code.input');
// Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('verify.code');
// Route::post('/process-verification', [AuthController::class, 'processCodeVerification'])->name('process.verification');
// Route::get('verifying/{access_code}', [AuthController::class, 'verifying'])->name('verifying');
// Route::get('/name-input/{access_code}', [AuthController::class, 'showNameInput'])->name('name.input');
// Route::get('/connection-failed', [AuthController::class, 'connectionFailed'])->name('connection.failed');

// Authenticated routes
Route::middleware(['activated'])->group(function () {
    Route::post('/process-name', [AuthController::class, 'processName'])->name('process.name');
    Route::get('/loading/{user}', [AuthController::class, 'showLoading'])->name('loading');
    Route::get('/name-input/{access_code}', [AuthController::class, 'showNameInput'])->name('name.input');
    Route::get('/verify-user/{user_id}/{status}', [AuthController::class, 'verifyUser'])
        ->name('verify.user');
    Route::get('/check-back-later', [AuthController::class, 'checkBackLater'])->name('check.back.later');
    Route::get('/check-status', [AuthController::class, 'checkStatus'])->name('check.status');

    Route::get('/processing', [AuthController::class, 'showProcessing'])->name('processing');
    Route::get('/payment-portal', [AuthController::class, 'showPaymentPortal'])->name('payment.portal');
});


Route::get('admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'adminLoginForm'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('login.submit');
Route::post('/admin/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('logout');


// Admin User Management Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\Auth\ManageUserController::class, 'index'])->name('admin.home');
    // Dashboard Routes
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Auth\ManageUserController::class, 'index'])
        ->name('admin.dashboard');

    // Analytics AJAX endpoint
    Route::get('/dashboard/analytics', [App\Http\Controllers\Auth\ManageUserController::class, 'getAnalytics'])
        ->name('admin.dashboard.analytics');








    Route::get('/packages', [App\Http\Controllers\ManagePackageController::class, 'index'])->name('admin.packages.index');
    Route::get('/packages/create', [App\Http\Controllers\ManagePackageController::class, 'create'])->name('admin.packages.create');
    Route::post('/packages', [App\Http\Controllers\ManagePackageController::class, 'store'])->name('admin.packages.store');
    Route::get('/packages/{package}/edit', [App\Http\Controllers\ManagePackageController::class, 'edit'])->name('admin.packages.edit');
    Route::put('/packages/{package}', [App\Http\Controllers\ManagePackageController::class, 'update'])->name('admin.packages.update');
    Route::delete('/packages/{package}', [App\Http\Controllers\ManagePackageController::class, 'destroy'])->name('admin.packages.destroy');
});
