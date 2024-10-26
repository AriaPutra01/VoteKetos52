<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

require __DIR__.'/auth.php';
