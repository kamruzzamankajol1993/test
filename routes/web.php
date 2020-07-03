<?php

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


Auth::routes();
	
	Route::get('/clear', function() {
		\Illuminate\Support\Facades\Artisan::call('cache:clear');
		\Illuminate\Support\Facades\Artisan::call('config:clear');
		\Illuminate\Support\Facades\Artisan::call('config:cache');
		\Illuminate\Support\Facades\Artisan::call('view:clear');
		\Illuminate\Support\Facades\Artisan::call('route:clear');
		return 'Cleared!';
	});
Route::group(['middleware' => ['auth']], function () {

    // Home and account

    Route::post('/search', 'HomeController@search')->name('search');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('account', 'AccountController@Account');
    Route::post('account', 'AccountController@update');

    // Product

    Route::get('/product/expired', 'ProductController@expired');
    Route::get('/product/outstock', 'ProductController@outstock');
    Route::get('product/pdf/{product}', 'ProductController@pdf')->name('product.pdf');
    Route::resource('product', 'ProductController');
    Route::post('/product/search', 'ProductController@search');
    Route::post('/product/sell', 'ProductController@sell');

    // Category

    Route::resource('category', 'CategoryController');

    // Sales

    Route::get('sales/invoice/{product}', 'SalesController@getInvoice')->name('sales.invoice');
    Route::get('sales/pdf/{product}', 'SalesController@pdf')->name('sales.pdf');
    Route::resource('sales', 'SalesController');
    Route::post('/sales/check', 'SalesController@check');
    Route::post('/sales/bk', 'SalesController@bk');
    Route::post('/sales/search', 'SalesController@search');

    // Suppliers

    Route::resource('suppliers', 'SuppliersController');

    //send money part
    Route::get('/sendmoney','TransectionController@index')->name('sendmoney');
     Route::get('/sendmoney/add','TransectionController@create')->name('sendmoney.create');
     Route::post('/sendmoney/store','TransectionController@store')->name('sendmoney.store');
     Route::post('/sendmoney/destroy/{id}','TransectionController@destroy')->name('sendmoney.destroy');
     Route::get('/sendmoney/edit/{id}','TransectionController@edit')->name('sendmoney.edit');
     Route::post('/sendmoney/update/','TransectionController@update')->name('sendmoney.update');
     Route::get('/sendmoney/search','TransectionController@search')->name('sendmoney.search');
    //send money part

    //receive money part
      Route::get('/receivemoney','TransectionController@indexreceive')->name('receivemoney');
     Route::get('/receivemoney/add','TransectionController@createreceive')->name('receivemoney.create');
     Route::post('/receivemoney/store','TransectionController@storereceive')->name('receivemoney.store');
     Route::post('/receivemoney/destroy/{id}','TransectionController@destroyreceive')->name('receivemoney.destroy');
       Route::get('/receivemoney/show/{id}','TransectionController@showreceive')->name('receivemoney.show');
     Route::get('/receivemoney/edit/{id}','TransectionController@editreceive')->name('receivemoney.edit');
     Route::get('/receivemoney/print/{id}','TransectionController@printreceive')->name('receivemoney.print');
     //Route::post('/receivemoney/update/','TransectionController@updatereceive')->name('receivemoney.update');
     Route::put('/receivemoney/update/{id}','TransectionController@updatereceive')->name('receivemoney.update');
     Route::get('/receivemoney/search','TransectionController@searchreceive')->name('receivemoney.search');
    //receive money part
     //location
     Route::post('/location/store','TransectionController@storelocation')->name('location.store');
     Route::get('/location/destroy/{id}','TransectionController@destroylocation')->name('location.destroy');
     //location

    // Language

    Route::get('language/{locale}', 'LanguageController@index');

    // Customers

    Route::get('customers/pdf/{customers}', 'CustomersController@pdf')->name('customers.pdf');
    Route::resource('customers', 'CustomersController');
    Route::post('/customers/search', 'CustomersController@search');

    // Setting

    Route::get('setting/lt', 'SettingController@lt')->name('setting.lt');
    Route::get('setting/printer', 'SettingController@printer')->name('setting.printer');
    Route::get('setting/other', 'SettingController@other')->name('setting.other');

    Route::match(['PUT','PATCH'], 'setting/lt/{setting}', [
            'uses'  => 'SettingController@ltUpdate',
            'as'    =>    'setting.ltUpdate',
        ]);
    Route::match(['PUT','PATCH'], 'setting/printer/{setting}', [
            'uses'  => 'SettingController@printerUpdate',
            'as'    => 'setting.printerUpdate'
        ]);
    Route::match(['PUT','PATCH'], 'setting/other/{setting}', [
            'uses'  => 'SettingController@otherUpdate',
            'as'    => 'setting.otherUpdate'
        ]);


    // Tools

    Route::get('tools/discount', 'ToolsController@discount')->name('tools.discount');
    Route::get('tools/dsearch', 'ToolsController@dsearch')->name('tools.dsearch');
    Route::get('tools/note', 'ToolsController@note')->name('tools.note');
    Route::post('tools', [
        'uses'  => 'ToolsController@noteStore',
        'as'    => 'tools.noteStore'
    ]);
    Route::match(['PUT','PATCH'], 'tools/note/{note}', [
            'uses'  => 'ToolsController@noteUpdate',
            'as'    => 'tools.noteUpdate'
     ]);
    Route::delete('tools/note/{note}', 'ToolsController@noteDestroy')->name('tools.noteDestroy');

    //Backups
    Route::get('setting/backup/get/{filename}', [
    'as' => 'backup.download',
    'uses' => 'BackupController@backupDownload']);
    Route::get('setting/backup', 'BackupController@backup')->name('setting.backup');
    Route::post('setting', 'BackupController@backupStore')->name('setting.backupStore');
    Route::delete('setting/backups/{setting}', 'BackupController@backupDestroy')->name('setting.backupDestroy');

    // Users

    Route::resource('users', 'UsersController');

    // Analysis

    Route::get('analysis', 'AnalysisController@index');
    Route::get('analysis/sales', 'AnalysisController@sales');
    Route::get('analysis/purchases', 'AnalysisController@purchases');
    Route::get('analysis/customers', 'AnalysisController@customers');
});
