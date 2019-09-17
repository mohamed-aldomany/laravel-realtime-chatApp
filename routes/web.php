<?php



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ChatController@welcome');
Route::middleware(['auth'])->group(function () {
    Route::get('/chat', 'ChatController@chat');
    Route::post('send', 'ChatController@send');
});

