<?php

use Illuminate\Support\Facades\Route;

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

// Show sites
Route::get('/', 'SiteController@index')->name('viewSites');

// Add site
Route::get('/site/add', 'SiteController@create')->name('createSite');
Route::post('/', 'SiteController@store')->name('storeSite');

// Edit site
Route::get('/site/{site}/edit', 'SiteController@edit')->name('editSite');
Route::post('/site/{site}', 'SiteController@update')->name('updateSite');

// Delete site
Route::delete('/site/{site}/delete', 'SiteController@destroy')->name('destroySite');

// Disable site
Route::post('/site/{site}/toggle', 'SiteController@toggle')->name('toggleSite');
