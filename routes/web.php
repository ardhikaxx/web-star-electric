<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SalesProductController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\ProfileController as EmployeeProfileController;
use App\Http\Controllers\Employee\ReportController as EmployeeReportController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [LandingController::class, 'sitemap']);
Route::get('/produk/{product}', [LandingController::class, 'showProduct'])->name('products.show');
Route::get('/produk/{product}/klik', [LandingController::class, 'clickProduct'])->name('products.click');

use Illuminate\Support\Facades\File;

Route::get('/uploads/products/{filename}', function ($filename) {
    $path = storage_path('uploads/products/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    return response($file, 200)->header('Content-Type', $type);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/forgot-pin', [AuthController::class, 'showForgotPin'])->name('pin.forgot');
    Route::post('/forgot-pin', [AuthController::class, 'verifyPhone'])->name('pin.forgot.submit');
    Route::get('/reset-pin', [AuthController::class, 'showResetPin'])->name('pin.reset.form');
    Route::post('/reset-pin', [AuthController::class, 'resetPin'])->name('pin.reset.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/admin/login', fn () => redirect()->route('login'))->name('admin.login');
Route::get('/admin/forgot-pin', fn () => redirect()->route('pin.forgot'))->name('admin.forgot-pin');
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth')->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/products/image/{image}', [ProductController::class, 'deleteImage'])->name('products.delete-image');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{user}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{user}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{user}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    Route::get('/sales-products', [SalesProductController::class, 'index'])->name('sales-products.index');
    Route::get('/sales-products/create', [SalesProductController::class, 'create'])->name('sales-products.create');
    Route::post('/sales-products', [SalesProductController::class, 'store'])->name('sales-products.store');
    Route::get('/sales-products/{salesProduct}/edit', [SalesProductController::class, 'edit'])->name('sales-products.edit');
    Route::put('/sales-products/{salesProduct}', [SalesProductController::class, 'update'])->name('sales-products.update');
    Route::delete('/sales-products/{salesProduct}', [SalesProductController::class, 'destroy'])->name('sales-products.destroy');

    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-excel', [AdminReportController::class, 'exportExcel'])->name('reports.export-excel');
    Route::get('/reports/export-pdf', [AdminReportController::class, 'exportPdf'])->name('reports.export-pdf');
    Route::get('/reports/{dailyReport}', [AdminReportController::class, 'show'])->name('reports.show');

    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('employee')->name('employee.')->middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');

    Route::get('/reports', [EmployeeReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [EmployeeReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [EmployeeReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{dailyReport}/edit', [EmployeeReportController::class, 'edit'])->name('reports.edit');
    Route::put('/reports/{dailyReport}', [EmployeeReportController::class, 'update'])->name('reports.update');
    Route::delete('/reports/{dailyReport}', [EmployeeReportController::class, 'destroy'])->name('reports.destroy');
    Route::get('/reports/{dailyReport}/print', [EmployeeReportController::class, 'print'])->name('reports.print');

    Route::get('/profile', [EmployeeProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [EmployeeProfileController::class, 'update'])->name('profile.update');
});
