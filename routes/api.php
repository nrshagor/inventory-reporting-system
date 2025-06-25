<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;

Route::post('/sales', [SaleController::class, 'store']);
Route::get('/report', [ReportController::class, 'summary']);
