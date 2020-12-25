<?php
use App\Http\Controllers\LanguageController;
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
// dashboard Routes
Route::get('/','StarterKitController@index');
Route::get('/sk-layout-1-column','StarterKitController@column_1Sk');
Route::get('/sk-layout-2-columns','StarterKitController@columns_2Sk');
Route::get('/fixed-navbar','StarterKitController@fix_navbar');
Route::get('/sk-layout-fixed','StarterKitController@fix_layout');
Route::get('/sk-layout-static','StarterKitController@static_layout');

// locale Route
Route::get('lang/{locale}',[LanguageController::class,'swap']);

// acess controller
Route::get('/access-control', 'AccessController@index');
Route::get('/access-control/{roles}', 'AccessController@roles');
Route::get('/ecommerce', 'AccessController@home')->middleware('role:Admin');

Auth::routes();

//master items
Route::get('/items/{modul}', 'masters\ItemsController@index');
Route::post('/save-items', 'masters\ItemsController@saveItems');
Route::post('/update-items', 'masters\ItemsController@updateItems');
Route::get('/hapus-items/{id}', 'masters\ItemsController@hapusItems');
Route::post('/find_master_barang', 'masters\ItemsController@cariItems');
Route::get('/price-items/{id}', 'masters\ItemsController@pagePrice');
Route::post('/update-harga-items', 'masters\ItemsController@updatePrice');



//master kategori
Route::get('/kategori', 'masters\mastersController@index');
Route::post('/save-kategori', 'masters\mastersController@saveKategori');
Route::post('/update-kategori', 'masters\mastersController@updateKategori');
Route::get('/hapus-kategori/{id}', 'masters\mastersController@hapusKategori');

//master user
Route::get('/users', 'masters\userController@index');
Route::post('/save-user', 'masters\userController@saveUser');
Route::post('/update-user', 'masters\userController@updateUser');
Route::get('/hapus-user/{id}', 'masters\userController@hapusUser');

//master supplier
Route::get('/supplier', 'masters\SupplierController@index');
Route::post('/save-supplier', 'masters\SupplierController@saveSupplier');
Route::post('/update-supplier', 'masters\SupplierController@updateSupplier');
Route::get('/hapus-supplier/{id}', 'masters\SupplierController@hapusSupplier');

//master customer
Route::get('/customer', 'masters\CustomerController@index');
Route::post('/save-customer', 'masters\CustomerController@saveCustomer');
Route::post('/update-customer', 'masters\CustomerController@updateCustomer');
Route::get('/hapus-customer/{id}', 'masters\CustomerController@hapusCustomer');

//transaksi receive
Route::get('/receive/{modul}', 'transaksi\ReceiveController@index');
Route::get('/buat-pembelian/{modul}', 'transaksi\ReceiveController@buat_pembelian');
Route::get('/delete-receive/{id}', 'transaksi\ReceiveController@deleteReceive');
// Route::post('/save-customer', 'masters\CustomerController@saveCustomer');
// Route::post('/update-customer', 'masters\CustomerController@updateCustomer');
// Route::get('/hapus-customer/{id}', 'masters\CustomerController@hapusCustomer');


//save cart

Route::post('/save-cart/{modul}', 'transaksi\cartController@saveCart');
Route::get('/clear-cart/{modul}', 'transaksi\cartController@clearCart');
Route::get('/delete-cart/{modul}', 'transaksi\cartController@deleteCart');


//transaksi penjualan

Route::get('/sales/{modul}', 'transaksi\IssuedController@index');
Route::get('/buat-sales/{modul}', 'transaksi\IssuedController@buat_sales');
Route::get('/delete-sales/{id}', 'transaksi\IssuedController@deleteSales');

//transaksi opname
Route::get('/opname', 'transaksi\OpnameController@index');
Route::get('/buat-opname/{modul}', 'transaksi\OpnameController@buat_opname');
Route::get('/delete-opname/{id}', 'transaksi\OpnameController@delete_opname');

//Setting Toko
Route::get('/setting', 'setting\SettingController@tokodata');
Route::post('/save_toko', 'setting\SettingController@saveToko');

// test function
Route::get('/tes', 'test\TesController@unik');
