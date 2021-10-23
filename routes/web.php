<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'PagesController@home');

Auth::routes([
  'register' => false
]);

Route::group(['prefix' => 'dashboard', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
  Route::get('/', 'DashboardController@index')->name('admin.dashboard');
  Route::get('/kategori', 'KategoriController@index')->name('admin.kategori');
  Route::post('/kategori', 'KategoriController@store')->name('admin.kategori.store');
  Route::post('/kategori/update', 'KategoriController@update')->name('admin.kategori.update');
  Route::post('/kategori/delete/{id?}', 'KategoriController@delete')->name('admin.kategori.delete');
  Route::get('/product', 'ProductController@index')->name('admin.product');
  Route::post('/product', 'ProductController@store')->name('admin.produck.store');
});
