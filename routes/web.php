<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;


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


Route::get('/', [LeadController::class,'index'])->name('upload');
Route::post('/', [LeadController::class,'uploadCsvFile']);
Route::get('list-import-status', [LeadController::class,'listImportStatus'])->name('list.import.status');
Route::get('list-csv-data/{id}', [LeadController::class,'listCsvData'])->name('list.csv');

