<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return redirect('/index');
});
Route::get('dashboard',function ()
{
    return view('Dashboard.index');
});
// Company Routes
Route::get('/company','CompanyController@index')->name('companies');
Route::get('/companies','CompanyController@companies')->name('getCompanies');
Route::post('/company/post','CompanyController@store')->name('company.store');
Route::get('company/delete/{id}','CompanyController@destroy')->name('company.delete');
Route::get('company/edit/{id}','CompanyController@edit')->name('company.edit');
Route::post('company/update/{id}','CompanyController@update')->name('company.update');
// Product Routes
Route::get('/product','ProductController@index')->name('products');
Route::get('/products','ProductController@product')->name('getProducts');
Route::post('/product/post','ProductController@store')->name('product.store');
Route::get('product/delete/{id}','ProductController@destroy')->name('product.delete');
Route::get('product/edit/{id}','ProductController@edit')->name('product.edit');
Route::post('product/update/{id}','ProductController@update')->name('product.update');

Auth::routes();
Route::get('logout', 'QovexController@logout');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('{any}', 'QovexController@index');

});

/*Route::get('pages-login', 'QovexController@index');
Route::get('pages-login-2', 'QovexController@index');
Route::get('pages-register', 'QovexController@index');
Route::get('pages-register-2', 'QovexController@index');
Route::get('pages-recoverpw', 'QovexController@index');
Route::get('pages-recoverpw-2', 'QovexController@index');
Route::get('pages-lock-screen', 'QovexController@index');
Route::get('pages-lock-screen-2', 'QovexController@index');
Route::get('pages-404', 'QovexController@index');
Route::get('pages-500', 'QovexController@index');
Route::get('pages-maintenance', 'QovexController@index');
Route::get('pages-comingsoon', 'QovexController@index');
Route::post('login-status', 'QovexController@checkStatus');*/
// You can also use auth middleware to prevent unauthenticated users

