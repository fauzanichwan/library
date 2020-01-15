<?php

Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/book', 'BookController@index');
Route::get('/book/create', 'BookController@create');
Route::post('/book/store', 'BookController@store');
Route::get('/book/{id}/edit', 'BookController@edit');
Route::put('/book/{id}', 'BookController@update');
Route::get('/book/{id}/delete', 'BookController@destroy');
Route::post('/book/loan', 'BookController@loan');

Route::get('/book/status', 'BookTransactionController@status');
Route::get('/bookLoan/{id}/edit', 'BookTransactionController@edit');
Route::get('/book/approval', 'BookTransactionController@index');

Route::get('/bookTransaction/{id}/approve', 'BookTransactionController@approve');
Route::get('/bookTransaction/{id}/return', 'BookTransactionController@return');
Route::get('/bookTransaction/{id}/reject', 'BookTransactionController@reject');
