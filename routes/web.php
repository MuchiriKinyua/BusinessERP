<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('salaries', App\Http\Controllers\SalaryController::class);
Route::resource('records', App\Http\Controllers\RecordController::class);
Route::resource('promotions', App\Http\Controllers\PromotionController::class);
Route::resource('payrolls', App\Http\Controllers\PayrollController::class);
Route::resource('offs', App\Http\Controllers\OffController::class);
Route::resource('leaves', App\Http\Controllers\LeaveController::class);
Route::resource('documentations', App\Http\Controllers\DocumentationController::class);
Route::resource('deductions', App\Http\Controllers\DeductionController::class);
Route::resource('banks', App\Http\Controllers\BankController::class);
Route::resource('allowances', App\Http\Controllers\AllowanceController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::post('verify-face', [AttendanceController::class, 'verifyFace'])->name('verify.face');
