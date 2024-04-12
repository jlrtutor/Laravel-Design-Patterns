<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/creational/abstract-factory', [\App\Http\Controllers\CreationalAbstractFactory::class, 'index']);
Route::get('/creational/singleton', [\App\Http\Controllers\CreationalSingleton::class, 'index']);
Route::get('/creational/builder', [\App\Http\Controllers\CreationalBuilder::class, 'index']);
Route::get('/creational/factory', [\App\Http\Controllers\CreationalFactory::class, 'index']);
Route::get('/creational/prototype', [\App\Http\Controllers\CreationalPrototype::class, 'index']);
Route::get('/creational/static-factory', [\App\Http\Controllers\CreationalStaticFactory::class, 'index']);

