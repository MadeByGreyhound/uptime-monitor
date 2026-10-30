<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Show sites
Route::get('/', [SiteController::class, 'index'])->name('viewSites');

// Add site
Route::get('/site/add', [SiteController::class, 'create'])->name('createSite');
Route::post('/', [SiteController::class, 'store'])->name('storeSite');

// Edit site
Route::get('/site/{site}/edit', [SiteController::class, 'edit'])->name('editSite');
Route::post('/site/{site}', [SiteController::class, 'update'])->name('updateSite');

// Delete site
Route::delete('/site/{site}/delete', [SiteController::class, 'destroy'])->name('destroySite');

// Disable site
Route::post('/site/{site}/toggle', [SiteController::class, 'toggle'])->name('toggleSite');

// Force uptime check
Route::post('/check', [SiteController::class, 'refresh'])->name('refresh');

// Logs
Route::get('/logs', [LogController::class, 'index'])->name('viewLogs');
Route::get('/logs/{site}', [LogController::class, 'site'])->name('viewSiteLogs');
