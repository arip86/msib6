<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function(){
    return view('front.home');
});
//contoh routing untuk mengarahkan ke view, tanpa melalui controller
Route::get('/percobaan_pertama', function(){
    return view('hello');
});
//contoh routing yang mengarahkan ke dirinya sendiri, tanpa view ataupun controller
Route::get('/salam', function(){
    return "<h1>Selamat Pagi Peserta MSIB</h1>";
});
//contoh routing yang menggunakan parameter
Route::get('/staff/{nama}/{divisi}', function($nama, $divisi){
    return 'Nama Pegawai '.$nama.'<br> Departemene: '.$divisi;
});
Route::get('/daftar_nilai', function(){
    //return view yang mengarahkan kedalam view yang didalamnya ada folder nilai dan file daftar_nilai
    return view('nilai.daftar_nilai');
});
Route::get('/dashboard', function(){
    return view ('admin.dashboard');
});

