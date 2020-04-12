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

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/unduh/{id}/pdf', 'PDFController@generate')->name('download.pdf');
Route::get('/unduh/publik/{key}', 'PDFController@public')->name('download.form');
Route::post('/unduh/publik/{key}', 'PDFController@downloadPDF')->name('download.final');
