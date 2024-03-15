<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CasualEmployeeController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Use the index method of CasualEmployeeController for the /dashboard route
    Route::get('/dashboard', [CasualEmployeeController::class, 'index'])->name('dashboard');
});




Route::post('/casuals/onboard', [CasualEmployeeController::class, 'onboard'])->name('casuals.onboard');

Route::get('/casuals/{casualEmployee}/edit', [CasualEmployeeController::class, 'edit'])->name('casuals.edit');
Route::put('/casuals/{casualEmployee}', [CasualEmployeeController::class, 'update'])->name('casuals.update');
// Route::get('/casual-employees/{casualEmployee}/download-form', 'CasualEmployeeController@downloadForm')->name('download.form');
Route::get('/casual-employees/{id}/download-form', 'CasualEmployeeController@downloadForm')->name('download.form');
Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('/casuals/{casualEmployee}/download-form', [CasualEmployeeController::class, 'downloadForm'])->name('casuals.downloadForm');
// Inside routes/web.php
Route::get('/download-pdf', 'CasualEmployeeController@downloadPDF')->name('download.pdf');
Route::get('/casual-employees/{id}/download-form', 'CasualEmployeeController@downloadPDF')->name('download.form');
Route::get('/generate-pdf/{casualEmployee}', [PDFController::class, 'generatePDF']);
