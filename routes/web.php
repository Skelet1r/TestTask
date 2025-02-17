<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/createAccount','createAccount')->middleware('guest')->name('createAccount');
    Route::post('/signIn','signIn')->middleware('guest')->name('signIn');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/getEmployees', 'getEmployees')->name('getEmployees');
    Route::get('/getEmployee/{id}', 'getEmployee')->name('getEmployee');
    Route::post('/addEmployee/{company_id}', 'addEmployee')->name('addEmployee');
    Route::put('/updateEmployee/{employee}', 'updateEmployee')->name('updateEmployee');
    Route::delete('/deleteEmployee/{employee}', 'deleteEmployee')->name('deleteEmployee');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/getCompanies', 'getCompanies')->name('getCompanies');
        Route::get('/getCompany/{id}', 'getCompany')->name('getCompany');
        Route::post('/addCompany', 'addCompany')->name('addCompany');
        Route::put('/updateCompany/{company}', 'updateCompany')->name('updateCompany');
        Route::delete('/deleteCompany/{company}', 'deleteCompany')->name('deleteCompany');
    });
});
