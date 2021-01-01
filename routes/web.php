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




// Route::post('/save-customer', 'masters\CustomerController@saveCustomer');
// Route::post('/update-customer', 'masters\CustomerController@updateCustomer');
// Route::get('/hapus-customer/{id}', 'masters\CustomerController@hapusCustomer');







// test function
Route::get('/tes', 'test\TesController@unik');
Route::get('/buatrole', 'test\TesController@didik');

Route::post('/find_master_barang', 'masters\ItemsController@cariItems');
//save cart
Route::post('/save-cart/{modul}', 'transaksi\cartController@saveCart');
Route::get('/clear-cart/{modul}', 'transaksi\cartController@clearCart');
Route::get('/delete-cart/{modul}', 'transaksi\cartController@deleteCart');
Route::post('/update-cart/{modul}', 'transaksi\cartController@updateCart');


Route::group(['middleware' => ['role:Admin']], function () {


    //master user
    Route::get('/users', 'masters\userController@index');
    Route::post('/save-user', 'masters\userController@saveUser');
    Route::post('/update-user', 'masters\userController@updateUser');
    Route::get('/hapus-user/{id}', 'masters\userController@hapusUser');
    Route::post('/update-akses', 'masters\userController@aksesUser');

    //master items
    Route::get('/items/{modul}', 'masters\ItemsController@index');
    Route::post('/save-items', 'masters\ItemsController@saveItems');
    Route::post('/update-items', 'masters\ItemsController@updateItems');
    Route::get('/hapus-items/{id}', 'masters\ItemsController@hapusItems');
    
    Route::get('/price-items/{id}', 'masters\ItemsController@pagePrice');
    Route::post('/update-harga-items', 'masters\ItemsController@updatePrice');
    

    //excell
    Route::get('/item-import', 'masters\ItemsController@importPage');
    Route::post('/import-file', 'masters\ItemsController@importFile');
    Route::get('/eksport-kategori', 'masters\ItemsController@eksportKategori');
    Route::get('/eksport-satuan', 'masters\ItemsController@eksportSatuan');
    Route::get('/download-master', function()
    {
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() .'/app/format/format item.xlsx';
        if (file_exists($file_path))
        {
            // Send Download
            return Response::download($file_path, 'master item.xlsx', [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    });

    //master kategori
    Route::get('/kategori', 'masters\mastersController@index');
    Route::post('/save-kategori', 'masters\mastersController@saveKategori');
    Route::post('/update-kategori', 'masters\mastersController@updateKategori');
    Route::get('/hapus-kategori/{id}', 'masters\mastersController@hapusKategori');

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

    //Setting Toko
    Route::get('/setting', 'setting\SettingController@tokodata');
    Route::post('/save_toko', 'setting\SettingController@saveToko');


});

Route::group(['middleware' => ['role:Purchase']], function () {
    //transaksi opname
    Route::get('/opname/{modul}', 'transaksi\OpnameController@index');
    Route::get('/buat-opname/{modul}', 'transaksi\OpnameController@buat_opname');
    Route::get('/delete-opname/{id}', 'transaksi\OpnameController@delete_opname');
    Route::get('/detail-opname/{id}', 'transaksi\OpnameController@detail_opname');

    //transaksi receive
    Route::get('/receive/{modul}', 'transaksi\ReceiveController@index');
    Route::get('/buat-pembelian/{modul}', 'transaksi\ReceiveController@buat_pembelian');
    Route::get('/delete-receive/{id}', 'transaksi\ReceiveController@deleteReceive');
    Route::get('/detail-receive/{id}', 'transaksi\ReceiveController@detailReceive');


});

Route::group(['middleware' => ['role:Kasir']], function () {
    //transaksi penjualan
    Route::get('/sales/{modul}', 'transaksi\IssuedController@index');
    Route::get('/buat-sales/{modul}', 'transaksi\IssuedController@buat_sales');
    Route::get('/delete-sales/{id}', 'transaksi\IssuedController@deleteSales');
    Route::get('/detail-issued/{id}', 'transaksi\IssuedController@detailIssued');
    Route::get('/lunasi-sales/{id}', 'transaksi\IssuedController@lunasiSales');
    
    


});

Route::group(['middleware' => ['role:Manager|Kasir|Purchase']], function () {
    //report
    Route::get('/stok-report', 'report\ReportController@stok_indek');
    Route::post('/generate-stok', 'report\ReportController@stok_generate');
    Route::get('/sales-report', 'report\ReportController@sales_indek');
    Route::post('/generate-sales', 'report\ReportController@sales_generate');
    Route::get('/receive-report', 'report\ReportController@receive_indek');
    Route::post('/generate-receive', 'report\ReportController@receive_generate');
});

