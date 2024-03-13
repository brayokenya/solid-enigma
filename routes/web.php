<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;use App\Http\Controllers\CasualEmployeeController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });

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