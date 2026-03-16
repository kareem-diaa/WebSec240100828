<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UsersController;

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


Route::get('/transcript', function () {
    $student = (object)[
        'name' => 'Kareem Diaa',
        'id'   => '240100828',
    ];

    $terms = [
        (object)[
            'name' => 'Spring 2026',
            'courses' => [
                (object)['code'=>'CS101','title'=>'Intro to CS',        'credits'=>3,'grade'=>'A'],
                (object)['code'=>'MATH1','title'=>'Calculus I',         'credits'=>3,'grade'=>'B+'],
                (object)['code'=>'ENG1', 'title'=>'English I',          'credits'=>2,'grade'=>'A-'],
                (object)['code'=>'PHYS1','title'=>'Physics I',          'credits'=>3,'grade'=>'B'],
            ]
        ],
        (object)[
            'name' => 'Spring 2025',
            'courses' => [
                (object)['code'=>'CS201','title'=>'Data Structures',    'credits'=>3,'grade'=>'A'],
                (object)['code'=>'MATH2','title'=>'Calculus II',        'credits'=>3,'grade'=>'A-'],
                (object)['code'=>'CS202','title'=>'OOP',                'credits'=>3,'grade'=>'B+'],
                (object)['code'=>'ENG2', 'title'=>'English II',         'credits'=>2,'grade'=>'A'],
            ]
        ],
    ];

    // Grade points map
    $gradePoints = [
        'A'=>4.0,'A-'=>3.7,'B+'=>3.3,'B'=>3.0,'B-'=>2.7,
        'C+'=>2.3,'C'=>2.0,'C-'=>1.7,'D'=>1.0,'F'=>0.0
    ];

    return view('transcript', compact('student', 'terms', 'gradePoints'));
});


Route::get('/products-catalog', function () {
    $products = [
        (object)['name'=>'LG TV 55"',           'price'=>25999, 'image'=>'https://placehold.co/300x200?text=LG+TV',        'description'=>'Smart 4K TV with HDR and built-in WiFi.'],
        (object)['name'=>'Samsung Refrigerator', 'price'=>18500, 'image'=>'https://placehold.co/300x200?text=Samsung+Fridge','description'=>'No-frost refrigerator with digital control.'],
        (object)['name'=>'iPhone 15',            'price'=>45000, 'image'=>'https://placehold.co/300x200?text=iPhone+15',    'description'=>'Apple iPhone 15 with A16 chip, 128GB.'],
        (object)['name'=>'Sony Headphones',      'price'=>4200,  'image'=>'https://placehold.co/300x200?text=Sony+WH1000', 'description'=>'Noise-cancelling wireless headphones.'],
        (object)['name'=>'Dell Laptop',          'price'=>32000, 'image'=>'https://placehold.co/300x200?text=Dell+Laptop',  'description'=>'Core i7, 16GB RAM, 512GB SSD.'],
        (object)['name'=>'PlayStation 5',        'price'=>22000, 'image'=>'https://placehold.co/300x200?text=PS5',          'description'=>'Next-gen gaming console by Sony.'],
    ];
    return view('products-catalog', compact('products'));
});

Route::get('/calculator', function () {
    return view('calculator');
});

Route::get('/gpa-simulator', function () {
    $courses = [
        (object)['code'=>'CS101',  'title'=>'Intro to Computer Science', 'credits'=>3],
        (object)['code'=>'MATH1',  'title'=>'Calculus I',                'credits'=>3],
        (object)['code'=>'ENG1',   'title'=>'English Communication',     'credits'=>2],
        (object)['code'=>'PHYS1',  'title'=>'Physics I',                 'credits'=>3],
        (object)['code'=>'CS102',  'title'=>'Programming Fundamentals',  'credits'=>3],
        (object)['code'=>'ARAB1',  'title'=>'Arabic Studies',            'credits'=>2],
    ];
    return view('gpa-simulator', compact('courses'));
});


// ── Users CRUD ──────────────────────────────────────────────
Route::get('users',                  [UsersController::class, 'list'])  ->name('users_list');
Route::get('users/edit/{user?}',     [UsersController::class, 'edit'])  ->name('users_edit');
Route::post('users/save/{user?}',    [UsersController::class, 'save'])  ->name('users_save');
Route::get('users/delete/{user}',    [UsersController::class, 'delete'])->name('users_delete');