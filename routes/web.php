<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CasualEmployeeController;
use App\Http\Controllers\BulkOnboardController;
use App\Http\Controllers\PDFController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\CasualEmployeesImportController;
use App\Http\Controllers\TimetrackingController;
use App\Http\Controllers\CompensationController;

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
Route::get('/bulk-onboard', [BulkOnboardController::class, 'showBulkOnboardForm'])->name('bulk.onboard.form');
Route::post('/bulk-onboard', [BulkOnboardController::class, 'bulkOnboard'])->name('bulk.onboard');
Route::get('/casuals/{casualEmployee}/edit', [CasualEmployeeController::class, 'edit'])->name('casuals.edit');
Route::put('/casuals/{casualEmployee}', [CasualEmployeeController::class, 'update'])->name('casuals.update');
// Route::get('/casual-employees/{casualEmployee}/download-form', 'CasualEmployeeController@downloadForm')->name('download.form');
Route::get('/casual-employees/{id}/download-form', 'CasualEmployeeController@downloadForm')->name('download.form');
Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('/casuals/{casualEmployee}/download-form', [CasualEmployeeController::class, 'downloadForm'])->name('casuals.downloadForm');
Route::get('/download-pdf', 'CasualEmployeeController@downloadPDF')->name('download.pdf');
Route::get('/casual-employees/{id}/download-form', 'CasualEmployeeController@downloadPDF')->name('download.form');
Route::get('/generate-pdf/{casualEmployee}', [PDFController::class, 'generatePDF']);
Route::get('/casual-employees/{id}/download-form', [CasualEmployeeController::class, 'downloadPDF'])->name('download.form');
Route::get('/casual-employees/{casualEmployee}/download-form', [CasualEmployeeController::class, 'downloadForm'])->name('casual_employee.downloadForm');
Route::get('/download-file', [CasualEmployeeController::class, 'downloadFile'])->name('download.file');
Route::put('/casuals/{casualEmployee}/offboard', 'CasualEmployeeController@offboard')->name('casuals.offboard');
Route::get('/casuals/filter', 'CasualEmployeeController@filter')->name('casuals.filter');
Route::get('/download-pdf', [CasualEmployeeController::class, 'exportToPDF'])->name('download.pdf');
Route::get('/casual-employees/export/pdf', [CasualEmployeeController::class, 'exportToPDF'])->name('casual-employees.export.pdf');
Route::post('/import-casual-employees', [CasualEmployeesImportController::class, 'import'])
    ->name('import.casual.employees');
Route::get('/casual-employees/export/excel', [CasualEmployeeController::class, 'exportToExcel'])->name('casual-employees.export.excel');
Route::post('/casual-employees/export/excel', [CasualEmployeeController::class, 'exportToExcel'])->name('casual-employees.export.excel');
Route::get('/upload-form', [CasualEmployeeController::class, 'showUploadForm'])->name('casual.upload.form');
Route::post('/upload', [CasualEmployeeController::class, 'upload'])->name('casual.upload');
Route::get('/timetrackings', [TimetrackingController::class, 'index'])->name('timetrackings.index');
Route::get('/timetrackings/export/excel', [TimetrackingController::class, 'exportToExcel'])->name('timetrackings.export.excel');
Route::get('/timetrackings/export/pdf', [TimetrackingController::class, 'exportToPDF'])->name('timetrackings.export.pdf');
Route::post('/timetrackings/export/pdf', [TimetrackingController::class, 'exportToPDF'])->name('timetrackings.export.pdf');

Route::get('/compensations', [CompensationController::class, 'index'])->name('compensations.index');
Route::post('/compensations', [CompensationController::class, 'store'])->name('compensations.store');
Route::put('/compensations/{compensation}/approve', [CompensationController::class, 'approve'])->name('compensations.approve');
Route::get('/compensations/payment-sheet', [CompensationController::class, 'generatePaymentSheet'])->name('compensations.payment-sheet');



