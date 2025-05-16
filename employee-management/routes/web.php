<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Department Routes
Route::resource('departments', DepartmentController::class);

// Employee Routes
Route::resource('employees', EmployeeController::class);

// Report Routes
Route::prefix('reports')->middleware('auth')->group(function () {
    Route::get('/employee-list', [EmployeeController::class, 'reportList'])->name('reports.employee_list');
    Route::get('/status-summary', [EmployeeController::class, 'reportSummaryStatus'])->name('reports.status_summary');
    Route::get('/status-by-department', [EmployeeController::class, 'reportStatusByDepartment'])->name('reports.status_by_department');
});
