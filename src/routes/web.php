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
Route::Post('/books', 'BooksController@store');
Route::Patch('/books/{book}', 'BooksController@update');
Route::Delete('/books/{book}', 'BooksController@destroy');

Route::Post('/author', 'AuthorController@store');
