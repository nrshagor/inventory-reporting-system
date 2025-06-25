<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;

Route::post('/sales', [SaleController::class, 'store']);
