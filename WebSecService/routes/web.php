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

Route::get('/minitest', function () {
    $items = [
        (object)['name' => 'Milk',        'qty' => 3,  'unit_price' => 25.00],
        (object)['name' => 'Bread',       'qty' => 2,  'unit_price' => 15.50],
        (object)['name' => 'Eggs (12)',   'qty' => 1,  'unit_price' => 45.00],
        (object)['name' => 'Butter',      'qty' => 2,  'unit_price' => 30.00],
        (object)['name' => 'Cheese',      'qty' => 1,  'unit_price' => 55.75],
        (object)['name' => 'Juice',       'qty' => 4,  'unit_price' => 18.00],
        (object)['name' => 'Rice (1kg)',  'qty' => 2,  'unit_price' => 22.00],
        (object)['name' => 'Chicken',     'qty' => 1,  'unit_price' => 120.00],
    ];
    return view('minitest', compact('items'));
});

