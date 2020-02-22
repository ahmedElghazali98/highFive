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
    Route::get('users', ['as' => 'admin.users.index', 'uses' => 'UserController@index', ])->middleware('permission:user');
    Route::get('users/edit', ['as' => 'admin.users.edit', 'uses' => 'UserController@edit', ['middleware' => ['permission:update_users']]]);
    Route::post('users/add', ['as' => 'admin.users.add', 'uses' => 'UserController@add', ['middleware' => ['permission:add_users']]]);
    Route::get('users/lang/{value}', ['as' => 'admin.users.lang', 'uses' => 'UserController@changeLanguage']);
    Route::post('users/update', ['as' => 'admin.users.update', 'uses' => 'UserController@update', ['middleware' => ['permission:update_users']]]);
    Route::post('users/UpdateStats', ['as' => 'admin.users.UpdateStats', 'uses' => 'UserController@UpdateStats', ['middleware' => ['permission:change_status_users']]]);
    Route::post('users/delete', ['as' => 'admin.users.delete', 'uses' => 'UserController@delete', ['middleware' => ['permission:delete_users']]]);
    Route::post('users/changepassword', ['as' => 'admin.users.changepassword', 'uses' => 'UserController@changepassword', ['middleware' => ['permission:change_password_user']]]);


   // user permission
    Route::post('users/userpermission', ['as' => 'admin.users.userpermission', 'uses' => 'UserController@userpermission']);
    Route::post('users/permission', ['as' => 'admin.users.getpermission', 'uses' => 'UserController@getpermission']);


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
  Route::get('items', ['as' => 'admin.items.index', 'uses' => 'itemController@index']);
  Route::post('items/add', ['as' => 'admin.items.add', 'uses' => 'itemController@add']);
  Route::get('items/edit', ['as' => 'admin.items.edit', 'uses' => 'itemController@edit']);
  Route::post('items/update', ['as' => 'admin.items.update', 'uses' => 'itemController@update']);
  Route::post('items/delete', ['as' => 'admin.items.delete', 'uses' => 'itemController@delete']);
  //Route::post('items/search', ['as' => 'admin.item.search.', 'uses' => 'itemController@searchItem']);
    Route::post('items/search', ['as' => 'admin.item.search.', 'uses' => 'itemController@search']);
    Route::get('items/{id}', ['as' => 'admin.item.get', 'uses' => 'itemController@searchItem']);
    Route::post('items/search_using_barcode', ['as' => 'admin.search_using_barcode.search.', 'uses' => 'itemController@search_using_barcode']);
    Route::post('items/search_item_production', ['as' => 'admin.search_item_production.search.', 'uses' => 'itemController@search_item_production']);



   //employess route
   Route::get('employess', ['as' => 'admin.employess.index', 'uses' => 'employessController@index']);
   Route::post('employess/add', ['as' => 'admin.employess.add', 'uses' => 'employessController@add']);
   Route::get('employess/edit', ['as' => 'admin.employess.edit', 'uses' => 'employessController@edit']);
   Route::post('employess/update', ['as' => 'admin.employess.update', 'uses' => 'employessController@update']);
   Route::post('employess/delete', ['as' => 'admin.employess.delete', 'uses' => 'employessController@delete']);


    //employess route
    Route::get('category_products', ['as' => 'admin.category_products.index', 'uses' => 'category_productsController@index']);
    Route::post('category_products/add', ['as' => 'admin.category_products.add', 'uses' => 'category_productsController@add']);
    Route::get('category_products/edit', ['as' => 'admin.category_products.edit', 'uses' => 'category_productsController@edit']);
    Route::post('category_products/update', ['as' => 'admin.category_products.update', 'uses' => 'category_productsController@update']);
    Route::post('category_products/delete', ['as' => 'admin.category_products.delete', 'uses' => 'category_productsController@delete']);




   //entryDocument route
   Route::get('entryDocument', ['as' => 'admin.entryDocument.index', 'uses' => 'entryDocumentController@index']);
   Route::post('entryDocument/add', ['as' => 'admin.entryDocument.add', 'uses' => 'entryDocumentController@add']);
   Route::get('entryDocument/edit', ['as' => 'admin.entryDocument.edit', 'uses' => 'entryDocumentController@edit']);
   Route::post('entryDocument/update', ['as' => 'admin.entryDocument.update', 'uses' => 'entryDocumentController@update']);
   Route::post('entryDocument/delete', ['as' => 'admin.entryDocument.delete', 'uses' => 'entryDocumentController@delete']);
   Route::get('entryDocument/pdf/{id}', ['as' => 'admin.entryDocument.pdf', 'uses' => 'entryDocumentController@export_pdf']);



   //stores route
   Route::get('stores', ['as' => 'admin.stores.index', 'uses' => 'storesController@index']);
   Route::post('stores/add', ['as' => 'admin.stores.add', 'uses' => 'storesController@add']);
   Route::get('stores/edit', ['as' => 'admin.stores.edit', 'uses' => 'storesController@edit']);
   Route::post('stores/update', ['as' => 'admin.stores.update', 'uses' => 'storesController@update']);
   Route::post('stores/delete', ['as' => 'admin.stores.delete', 'uses' => 'storesController@delete']);
   Route::get('export', ['as' => 'admin.stores.export', 'uses' => 'storesController@export']);


   //internal_store_movements route
   Route::get('internal_store_movements', ['as' => 'admin.internal_store_movements.index', 'uses' => 'internal_store_movementsController@index' ,['middleware' => ['permission:publish']]]);
   Route::post('internal_store_movements/add', ['as' => 'admin.internal_store_movements.add', 'uses' => 'internal_store_movementsController@add']);
   Route::get('internal_store_movements/edit', ['as' => 'admin.internal_store_movements.edit', 'uses' => 'internal_store_movementsController@edit']);
   Route::post('internal_store_movements/update', ['as' => 'admin.internal_store_movements.update', 'uses' => 'internal_store_movementsController@update']);
   Route::post('internal_store_movements/delete', ['as' => 'admin.internal_store_movements.delete', 'uses' => 'internal_store_movementsController@delete']);
   Route::get('internal_store_movements/get_log', ['as' => 'admin.internal_store_movements.get_log', 'uses' => 'internal_store_movementsController@get_log']);



   //cars route
   Route::get('cars', ['as' => 'admin.cars.index', 'uses' => 'carsController@index']);
   Route::post('cars/add', ['as' => 'admin.cars.add', 'uses' => 'carsController@add']);
   Route::get('cars/edit', ['as' => 'admin.cars.edit', 'uses' => 'carsController@edit']);
   Route::post('cars/update', ['as' => 'admin.cars.update', 'uses' => 'carsController@update']);
   Route::post('cars/delete', ['as' => 'admin.cars.delete', 'uses' => 'carsController@delete']);



   // items_production route
   Route::get('items_production', ['as' => 'admin.items_production.index', 'uses' => 'items_productionController@index']);
   Route::post('items_production/add', ['as' => 'admin.items_production.add', 'uses' => 'items_productionController@add']);
   Route::get('items_production/edit', ['as' => 'admin.items_production.edit', 'uses' => 'items_productionController@edit']);
   Route::post('items_production/update', ['as' => 'admin.items_production.update', 'uses' => 'items_productionController@update']);
   Route::post('items_production/delete', ['as' => 'admin.items_production.delete', 'uses' => 'items_productionController@delete']);



   //dismantling_product route
   Route::get('dismantling_product', ['as' => 'admin.dismantling_product.index', 'uses' => 'dismantling_productController@index']);
   Route::post('dismantling_product/add', ['as' => 'admin.dismantling_product.add', 'uses' => 'dismantling_productController@add']);
   Route::get('dismantling_product/edit', ['as' => 'admin.dismantling_product.edit', 'uses' => 'dismantling_productController@edit']);
   Route::post('dismantling_product/update', ['as' => 'admin.dismantling_product.update', 'uses' => 'dismantling_productController@update']);
   Route::post('dismantling_product/delete', ['as' => 'admin.dismantling_product.delete', 'uses' => 'dismantling_productController@delete']);


    //tax_category route
    Route::get('tax_category', ['as' => 'admin.tax_category.index', 'uses' => 'tax_categoryController@index']);
    Route::post('tax_category/add', ['as' => 'admin.tax_category.add', 'uses' => 'tax_categoryController@add']);
    Route::get('tax_category/edit', ['as' => 'admin.tax_category.edit', 'uses' => 'tax_categoryController@edit']);
    Route::post('tax_category/update', ['as' => 'admin.tax_category.update', 'uses' => 'tax_categoryController@update']);
    Route::post('tax_category/delete', ['as' => 'admin.tax_category.delete', 'uses' => 'tax_categoryController@delete']);




    //taxes route
    Route::get('taxes', ['as' => 'admin.taxes.index', 'uses' => 'taxesController@index']);
    Route::post('taxes/add', ['as' => 'admin.taxes.add', 'uses' => 'taxesController@add']);
    Route::get('taxes/edit', ['as' => 'admin.taxes.edit', 'uses' => 'taxesController@edit']);
    Route::post('taxes/update', ['as' => 'admin.taxes.update', 'uses' => 'taxesController@update']);
    Route::post('taxes/delete', ['as' => 'admin.taxes.delete', 'uses' => 'taxesController@delete']);





    //store_item route
    Route::get('store_item', ['as' => 'admin.store_item.index', 'uses' => 'store_itemController@index']);
    Route::post('store_item/add', ['as' => 'admin.store_item.add', 'uses' => 'store_itemController@add']);
    Route::get('store_item/edit', ['as' => 'admin.store_item.edit', 'uses' => 'store_itemController@edit']);
    Route::post('store_item/update', ['as' => 'admin.store_item.update', 'uses' => 'store_itemController@update']);
    Route::post('store_item/delete', ['as' => 'admin.store_item.delete', 'uses' => 'store_itemController@delete']);



    //store_item route
    Route::get('store_bills', ['as' => 'admin.store_bills.index', 'uses' => 'store_billsController@index']);
    Route::post('store_bills/add', ['as' => 'admin.store_bills.add', 'uses' => 'store_billsController@add']);
    Route::get('store_bills/edit', ['as' => 'admin.store_bills.edit', 'uses' => 'store_billsController@edit']);
    Route::post('store_bills/update', ['as' => 'admin.store_bills.update', 'uses' => 'store_billsController@update']);
    Route::post('store_bills/delete', ['as' => 'admin.store_bills.delete', 'uses' => 'store_billsController@delete']);
    Route::get('store_bills/get_log', ['as' => 'admin.store_bills.get_log', 'uses' => 'store_billsController@get_log']);














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
