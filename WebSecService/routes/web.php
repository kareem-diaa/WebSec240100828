<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); //welcome.blade.php
});

Route::get('/multable/{number?}', function ($number = null) {
    $j = $number ?? 6;
    return view('multable', compact('j'));
}); //multable.blade.php

Route::get('/even', function () {
    return view('even'); //even.blade.php
});

Route::get('/odd', function () {
    return view('odd'); //odd.blade.php
});

Route::get('/prime', function () {
    return view('prime'); //prime.blade.php
});
