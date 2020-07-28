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


    Route::get('/bank','BankinfoController@bmanage')->name('bank');
     Route::get('/bank/create','BankinfoController@bcreate')->name('bank.create');
     Route::post('/bank/store','BankinfoController@bstore')->name('bank.store');
      Route::get('/bank/edit/{id}','BankinfoController@bedit')->name('bank.edit');
     Route::post('/bank/update/','BankinfoController@bupdate')->name('bank.update');


     Route::get('/check/{id}','BankinfoController@cmanage')->name('check');
     Route::get('/check/create','BankinfoController@ccreate')->name('check.create');
     Route::post('/check/store','BankinfoController@cstore')->name('check.store');


     Route::get('/deposite','DepositeController@manage')->name('deposite');
     Route::get('/deposite/create','DepositeController@create')->name('deposite.create');
     Route::post('/deposite/store','DepositeController@store')->name('deposite.store');
     Route::get('/findProductName1','DepositeController@findProductName1');

      Route::get('/withdraw','WithdrawController@manage')->name('withdraw');
     Route::get('/withdraw/create','WithdrawController@create')->name('withdraw.create');
     Route::post('/withdraw/store','WithdrawController@store')->name('withdraw.store');
     Route::get('/check/search/withdraw','WithdrawController@search')->name('withdraw.search');


      Route::post('/fund/return/store','FundController@rstore')->name('fund.rstore');
      Route::get('/fund/history','FundController@history')->name('fund.history');
      Route::get('/findProductName','FundController@findProductName');
	
	
	Route::get('/fund','FundController@index')->name('fund');
     Route::get('/fund/return','FundController@return')->name('fund.return');
     Route::post('/fund/store','FundController@store')->name('fund.store');
      Route::post('/fund/return/store','FundController@rstore')->name('fund.rstore');
      Route::get('/fund/history','FundController@history')->name('fund.history');
      Route::get('/findProductName','FundController@findProductName');
      
     
	
	 Route::post('/redirect/customer/{id}','TransectionController@re1')->name('redir1');
	 Route::post('/redirect/smoney/{id}','TransectionController@re2')->name('redir2');
	Route::post('/redirect/rmoney/{id}','TransectionController@re3')->name('redir3');
	
	
	 Route::get('/receivemoney/search','TransectionController@searchreceive')->name('receivemoney.search');
     Route::get('/sendmoney/search','TransectionController@search')->name('sendmoney.search');
	
	Route::get('/new/reverse/{add}','ReverseController@new1history')->name('r1.history');
     Route::get('/new/reverse_other_branch/','ReverseController@new2history')->name('r2.history');
     Route::post('/new/reverse_other_branchs/','ReverseController@new2history3')->name('r3.history');
     
     
	Route::get('/all/print/{add}', 'SubuserController@npprint')->name('new');
	Route::get('/new/history/','SubuserController@new1history')->name('new1.history');
     Route::get('/new/history_all/','SubuserController@new2history')->name('new2.history');
	
	 Route::post('/branch/login', 'BranchController@login')->name('branch.login');
    Route::get('/branch/dashboard/', 'BranchController@dashboard')->name('branch.dashboard');
    Route::get('/branch_login', 'BranchController@blogin')->name('branch_login');
    Route::get('/branch_logout', 'BranchController@blogout')->name('branch_logout');
    Route::get('/all/history', 'BranchController@all')->name('all');
      Route::get('/status/main/{id}', 'BranchtransectionController@supdate1')->name('status1.get');
     Route::post('/status/update', 'BranchtransectionController@supdate')->name('status.update');
     Route::post('b/status/update', 'BranchtransectionController@bsupdate')->name('bstatus.update');
     
     Route::get('/user_profile','SubBranchController@indexp')->name('user_profile');
     Route::get('/user_profile/add','SubBranchController@createp')->name('user_profile.create');
     Route::post('/user_profile/store','SubBranchController@storep')->name('user_profile.store');
     Route::get('/user_profile/detail/{id}','SubBranchController@historyp')->name('user_profile.history');
     Route::post('/user_profile/destroy/{id}','SubBranchController@destroyp')->name('user_profile.destroy');
     Route::get('/user_profile/edit/{id}','SubBranchController@editp')->name('user_profile.edit');
     Route::post('/user_profile/update/','SubBranchController@updatep')->name('user_profile.update');
 Route::get('/user_profile/active/{id}','SubBranchController@active')->name('user_profile.active');
     Route::get('/user_profile/inactive/{id}','SubBranchController@inactive')->name('user_profile.inactive');

    Route::get('/sub_branch','SubBranchController@index')->name('subbranch');
     Route::get('/sub_branch/add','SubBranchController@create')->name('subbranch.create');
     Route::post('/sub_branch/store','SubBranchController@store')->name('subbranch.store');
     Route::post('/sub_branch/destroy/{id}','SubBranchController@destroy')->name('subbranch.destroy');
     Route::get('/sub_branch/edit/{id}','SubBranchController@edit')->name('subbranch.edit');
     Route::post('/sub_branch/update/','SubBranchController@update')->name('subbranch.update');

     Route::get('/sub_user','SubuserController@index')->name('subuser');
     Route::get('/sub_user/add','SubuserController@create')->name('subuser.create');
     Route::post('/sub_user/store','SubuserController@store')->name('subuser.store');
     Route::post('/sub_user/destroy/{id}','SubuserController@destroy')->name('subuser.destroy');
     Route::get('/sub_user/edit/{id}','SubuserController@edit')->name('subuser.edit');
     Route::post('/sub_user/update/','SubuserController@update')->name('subuser.update');
     Route::get('/sub_user/history/{add}','SubuserController@history')->name('subuser.history');
Route::get('/sub_user/sender/history/','SubuserController@senderhistory')->name('subusersend.history');
     Route::get('/sub_user/sender/search/','SubuserController@sendersearch')->name('subusersend.search');
     //send money part
     Route::get('/su/sendmoney','BranchtransectionController@index')->name('branch.sendmoney');
     Route::get('/su/sendmoney/add','BranchtransectionController@create')->name('branch.sendmoney.create');
     Route::post('/su/sendmoney/store','BranchtransectionController@store')->name('branch.sendmoney.store');
     Route::post('/su/sendmoney/store/print','BranchtransectionController@storeprint')->name('branch.sendmoney.store.print');
     Route::post('/su/sendmoney/destroy/{id}','BranchtransectionController@destroy')->name('branch.sendmoney.destroy');
     Route::get('/su/sendmoney/edit/{id}','BranchtransectionController@edit')->name('branch.sendmoney.edit');
     Route::post('/su/sendmoney/update/','BranchtransectionController@update')->name('branch.sendmoney.update');
     Route::get('/su/sendmoney/search','BranchtransectionController@search')->name('branch.sendmoney.search');



    Route::get('/branch/sendmoney','BranchtransectionController@index')->name('branch.sendmoney');
     Route::get('/branch/sendmoney/add','BranchtransectionController@create')->name('branch.sendmoney.create');
     Route::post('/branch/sendmoney/store','BranchtransectionController@store')->name('branch.sendmoney.store');
     //Route::post('/branch/sendmoney/store/print','BranchtransectionController@storeprint')->name('branch.sendmoney.store.print');
     Route::post('/branch/sendmoney/destroy/{id}','BranchtransectionController@destroy')->name('branch.sendmoney.destroy');
     Route::get('/branch/sendmoney/edit/{id}','BranchtransectionController@edit')->name('branch.sendmoney.edit');
     Route::post('/branch/sendmoney/update/','BranchtransectionController@update')->name('branch.sendmoney.update');
     Route::get('/branch/sendmoney/search','BranchtransectionController@search')->name('branch.sendmoney.search');
     Route::get('/branch/sendmoney/store/print/{id}','BranchtransectionController@storeprint')->name('branchsendmoney.print');
    //send money part

    //receive money part
      Route::get('/branch/receivemoney','BranchtransectionController@indexreceive')->name('branch.receivemoney');
     Route::get('/branch/receivemoney/add','BranchtransectionController@createreceive')->name('branch.receivemoney.create');
     Route::post('/branch/receivemoney/store','BranchtransectionController@storereceive')->name('branch.receivemoney.store');
     Route::post('/branch/receivemoney/destroy/{id}','BranchtransectionController@destroyreceive')->name('branch.receivemoney.destroy');
       Route::get('/branch/receivemoney/show/{id}','BranchtransectionController@showreceive')->name('branch.receivemoney.show');
     Route::get('/branch/receivemoney/edit/{id}','BranchtransectionController@editreceive')->name('branch.receivemoney.edit');
     Route::get('/branch/receivemoney/print/{id}','BranchtransectionController@printreceive')->name('branch.receivemoney.print');
     //Route::post('/receivemoney/update/','TransectionController@updatereceive')->name('receivemoney.update');
     Route::post('/branch/receivemoney/update','BranchtransectionController@updatereceive')->name('branch.receivemoney.update');
      Route::post('/branch/receivemoney/update/status','BranchtransectionController@updatereceivestatus')->name('branch.receivemoney.update.status');
     Route::get('/branch/receivemoney/search','BranchtransectionController@searchreceive')->name('branch.receivemoney.search');

     Route::get('/branch/history','BranchtransectionController@history')->name('branch.history');
    //receive money part
    
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


    //purchase
    Route::resource('purchase','PurchaseController');

    // Suppliers

    Route::resource('suppliers', 'SuppliersController');

    //send money part
    Route::get('/sendmoney','TransectionController@index')->name('sendmoney');
     Route::get('/sendmoney/add','TransectionController@create')->name('sendmoney.create');
     Route::post('/sendmoney/store','TransectionController@store')->name('sendmoney.store');
     Route::post('/sendmoney/destroy/{id}','TransectionController@destroy')->name('sendmoney.destroy');
     Route::get('/sendmoney/edit/{id}','TransectionController@edit')->name('sendmoney.edit');
     Route::post('/sendmoney/update/','TransectionController@update')->name('sendmoney.update');
    
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
   
    //receive money part
    //branch
     Route::get('/branch','BranchController@index')->name('branch');
     Route::get('/branch/add','BranchController@create')->name('branch.create');
     Route::post('/branch/store','BranchController@store')->name('branch.store');
     Route::post('/branch/destroy/{id}','BranchController@destroy')->name('branch.destroy');
     Route::get('/branch/edit/{slug}','BranchController@edit')->name('branch.edit');
     Route::post('/branch/update/','BranchController@update')->name('branch.update');
    Route::get('/branch/history/{add}','BranchController@history')->name('branch1.history');
     //branch
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

    Route::get('/product_search','ProductController@product_search')->name('product_search');
    Route::get('/product_select','ProductController@product_select')->name('product_select');

    Route::get('/find_customer','CustomersController@find_customer')->name('find_customer');
    Route::get('/autoCompleteProductSearch','SalesController@autoCompleteProductSearch')->name('product_query_on_sale');
    Route::get('/get_data_of_selected_item','SalesController@get_data_of_selected_item')->name('get_data_of_selected_item');
    Route::get('/get_product_by_batch_id','SalesController@get_product_by_batch_id')->name('get_product_by_batch_id');
});
