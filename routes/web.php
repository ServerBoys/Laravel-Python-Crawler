<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function (Request $request) {
    $links = [];
    if (isset($request->url) && Str::of($request->url)
            ->test('/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/\/=]*)/'))
    {
        $url = $request->url;
        $output = Process::path(base_path('python'))->input($url)->run('python3.6 crawl.py' )->output();
        $links = json_decode($output, true);
        if (isset($links['error']))
            $links = [];
    }

    return view('crawler', data: [
        'links' => $links,
    ]);
})->name('crawler');
