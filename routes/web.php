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

Route::get('/home', function () {
   return redirect('/admin/dashboard');

});
// LOGIN ROUTE


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['web', 'guest']], function () {
    // LOGIN ROUTE
    Route::get('/login', ['as' => 'login', 'uses' => 'LoginAdminController@getIndex']);
    Route::post('adminlogin', ['as' => 'adminlogin', 'uses' => 'LoginAdminController@postIndex']);
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    // DASHBOARD ROUTE
    Route::get('dashboard', ['as' => 'admin.dashboard.view', 'uses' => 'DashboardController@index']);
    Route::get('dashboard/profile', ['as' => 'admin.dashboard.profile', 'uses' => 'DashboardController@getProfile']);
    Route::get('dashboard/getFund', ['as' => 'admin.dashboard.getFund', 'uses' => 'DashboardController@getFund']);
    Route::post('dashboard/password', ['as' => 'admin.dashboard.password', 'uses' => 'DashboardController@postPassword']);
    Route::post('dashboard/close_fund', ['as' => 'admin.dashboard.close_fund', 'uses' => 'DashboardController@close_fund']);
    Route::get('dashboard/details', ['as' => 'admin.dashboard.details', 'uses' => 'DashboardController@orderDetails']);
    Route::post('dashboard/UpdateStats', ['as' => 'admin.dashboard.UpdateStats', 'uses' => 'DashboardController@UpdateStats']);
    Route::post('dashboard/delete', ['as' => 'admin.dashboard.delete', 'uses' => 'DashboardController@delete']);

    // USERS ROUTE
    Route::get('users', ['as' => 'admin.users.index', 'uses' => 'UserController@index', ['middleware' => ['permission:user']]]);
    Route::get('users/edit', ['as' => 'admin.users.edit', 'uses' => 'UserController@edit', ['middleware' => ['permission:update_users']]]);
    Route::get('users/getpermission', ['as' => 'admin.users.getpermission', 'uses' => 'UserController@getpermission']);
    Route::post('users/add', ['as' => 'admin.users.add', 'uses' => 'UserController@add', ['middleware' => ['permission:add_users']]]);
    Route::get('users/lang/{value}', ['as' => 'admin.users.lang', 'uses' => 'UserController@changeLanguage']);
    Route::post('users/update', ['as' => 'admin.users.update', 'uses' => 'UserController@update', ['middleware' => ['permission:update_users']]]);
    Route::post('users/UpdateStats', ['as' => 'admin.users.UpdateStats', 'uses' => 'UserController@UpdateStats', ['middleware' => ['permission:change_status_users']]]);
    Route::post('users/delete', ['as' => 'admin.users.delete', 'uses' => 'UserController@delete', ['middleware' => ['permission:delete_users']]]);
    Route::post('users/changepassword', ['as' => 'admin.users.changepassword', 'uses' => 'UserController@changepassword', ['middleware' => ['permission:change_password_user']]]);


   // user permission
    Route::post('users/userpermission', ['as' => 'admin.users.userpermission', 'uses' => 'UserController@userpermission']);


    //suppliers route
    Route::get('suppliers', ['as' => 'admin.suppliers.index', 'uses' => 'suppliersController@index']);
    Route::post('suppliers/add', ['as' => 'admin.suppliers.add', 'uses' => 'suppliersController@add']);
    Route::get('suppliers/edit', ['as' => 'admin.suppliers.edit', 'uses' => 'suppliersController@edit']);
    Route::post('suppliers/update', ['as' => 'admin.suppliers.update', 'uses' => 'suppliersController@update']);
    Route::post('suppliers/delete', ['as' => 'admin.suppliers.delete', 'uses' => 'suppliersController@delete']);


  //price category route
  Route::get('price_category', ['as' => 'admin.price_category.index', 'uses' => 'price_categoryController@index']);
  Route::post('price_category/add', ['as' => 'admin.price_category.add', 'uses' => 'price_categoryController@add']);
  Route::get('price_category/edit', ['as' => 'admin.price_category.edit', 'uses' => 'price_categoryController@edit']);
  Route::post('price_category/update', ['as' => 'admin.price_category.update', 'uses' => 'price_categoryController@update']);
  Route::post('price_category/delete', ['as' => 'admin.price_category.delete', 'uses' => 'price_categoryController@delete']);


  //customers route
  Route::get('customers', ['as' => 'admin.customers.index', 'uses' => 'customerController@index']);
  Route::post('customers/add', ['as' => 'admin.customers.add', 'uses' => 'customerController@add']);
  Route::get('customers/edit', ['as' => 'admin.customers.edit', 'uses' => 'customerController@edit']);
  Route::post('customers/update', ['as' => 'admin.customers.update', 'uses' => 'customerController@update']);
  Route::post('customers/delete', ['as' => 'admin.customers.delete', 'uses' => 'customerController@delete']);



  //system_constants route
  Route::get('system_constants', ['as' => 'admin.system_constants.index', 'uses' => 'system_constantsController@index']);
  Route::post('system_constants/add', ['as' => 'admin.system_constants.add', 'uses' => 'system_constantsController@add']);
  Route::get('system_constants/edit', ['as' => 'admin.system_constants.edit', 'uses' => 'system_constantsController@edit']);
  Route::post('system_constants/update', ['as' => 'admin.system_constants.update', 'uses' => 'system_constantsController@update']);
  Route::post('system_constants/delete', ['as' => 'admin.system_constants.delete', 'uses' => 'system_constantsController@delete']);



  //categoties route
  Route::get('categoties', ['as' => 'admin.categoties.index', 'uses' => 'categoryController@index']);
  Route::post('categoties/add', ['as' => 'admin.categoties.add', 'uses' => 'categoryController@add']);
  Route::get('categoties/edit', ['as' => 'admin.categoties.edit', 'uses' => 'categoryController@edit']);
  Route::post('categoties/update', ['as' => 'admin.categoties.update', 'uses' => 'categoryController@update']);
  Route::post('categoties/delete', ['as' => 'admin.categoties.delete', 'uses' => 'categoryController@delete']);


   //employess route
   Route::get('employess', ['as' => 'admin.employess.index', 'uses' => 'employessController@index']);
   Route::post('employess/add', ['as' => 'admin.employess.add', 'uses' => 'employessController@add']);
   Route::get('employess/edit', ['as' => 'admin.employess.edit', 'uses' => 'employessController@edit']);
   Route::post('employess/update', ['as' => 'admin.employess.update', 'uses' => 'employessController@update']);
   Route::post('employess/delete', ['as' => 'admin.employess.delete', 'uses' => 'employessController@delete']);



   //suppliers route
   Route::get('entryDocument', ['as' => 'admin.entryDocument.index', 'uses' => 'entryDocumentController@index']);
   Route::post('entryDocument/add', ['as' => 'admin.entryDocument.add', 'uses' => 'entryDocumentController@add']);
   Route::get('entryDocument/edit', ['as' => 'admin.entryDocument.edit', 'uses' => 'entryDocumentController@edit']);
   Route::post('entryDocument/update', ['as' => 'admin.entryDocument.update', 'uses' => 'entryDocumentController@update']);
   Route::post('entryDocument/delete', ['as' => 'admin.entryDocument.delete', 'uses' => 'entryDocumentController@delete']);

   Route::post('search/item', ['as' => 'admin.item.search.', 'uses' => 'entryDocumentController@searchItem']);






    // Route Logout
    Route::get('/logout', ['as' => 'admin.dashboard.logout', 'uses' => 'LoginAdminController@getLogout']);

    Route::get('/clear', function () {
        Cache::forget('spatie.permission.cache');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('config:cache');
        return 'cleared';
    });

    // set lang

    Route::get('locale/{locale}', function ($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    });
});
