<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// Route url
// Route::get('/', 'DashboardController@dashboardAnalytics');

// Route Dashboards
Route::get('/dashboard-analytics', 'DashboardController@dashboardAnalytics');

// Route Components
Route::get('/sk-layout-2-columns', 'StaterkitController@columns_2');
Route::get('/sk-layout-fixed-navbar', 'StaterkitController@fixed_navbar');
Route::get('/sk-layout-floating-navbar', 'StaterkitController@floating_navbar');
Route::get('/sk-layout-fixed', 'StaterkitController@fixed_layout');

// acess controller
Route::get('/access-control', 'AccessController@index');
Route::get('/access-control/{roles}', 'AccessController@roles');
Route::get('/modern-admin', 'AccessController@home')->middleware('permissions:approve-post');

// Auth::routes();

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Auth::routes();

Route::middleware('auth')->group(function () {
  Route::get('/', 'HomeController@index');
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/users', 'UserController@displayUsers')->name('users.get');
  Route::get('/logout', 'HomeController@logout');
  Route::get('/user-dashboard', 'UserController@index')->name('userdashboard');
  Route::get('/view-user/{user}', 'UserController@show');
  Route::get('/edit-user/{user}/edit', 'UserController@edit');
  Route::put('/edit-user/{user}', 'UserController@update');
  Route::get('/update-profile', 'ProfileController@edit');
  Route::put('/edit-self', 'ProfileController@update');
  Route::get('/change-user-password', 'ChangePasswordController@edit')->name('change-password');
  Route::put('/change-user-password', 'ChangePasswordController@update')->name('changepassword');
  Route::get('/delete-user/{user}', 'UserController@destroy')->name('userdelete');
  Route::get('/user-approve', 'UserApproveDeclineController@store');
  Route::get('/user-decline', 'UserApproveDeclineController@store');

  Route::get('/users', 'UserController@index')->name('users.index');
  Route::post('/users', 'UserController@create')->name('users.show');
  Route::get('/users/{user}', 'UserController@show')->name('users.show');
  Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
  Route::put('/users/{user}', 'UserController@update')->name('users.update');
  Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');

  Route::get('/companies', 'CompanyController@index')->name('companies.index');
  Route::get('/companies/create', 'CompanyController@create')->name('companies.create');
  Route::get('/companies/{company}', 'CompanyController@show');
  Route::get('/companies.getAll', 'CompanyController@getCompanies')->name('companies.get');
  Route::post('/companies', 'CompanyController@store')->name('companies.store');
  Route::get('/companies/{company}/edit', 'CompanyController@edit');
  Route::put('/companies/{company}', 'CompanyController@update');
  Route::delete('/companies/{company}', 'CompanyController@destroy');

  Route::get('/features', 'FeatureController@index')->name('features.index');
  Route::get('/features/create', 'FeatureController@create')->name('features.create');
  Route::post('/features', 'FeatureController@store')->name('features.store');
  Route::get('/features/{feature}', 'FeatureController@show')->name('features.show');
  Route::get('/features/{feature}/edit', 'FeatureController@edit')->name('features.edit');
  Route::put('/features/{feature}', 'FeatureController@update')->name('features.update');
  Route::delete('/features/{feature}', 'FeatureController@destroy')->name('features.destroy');

  Route::get('/vehicles', 'VehicleController@index')->name('vehicles.index');
  Route::get('/vehicles/create', 'VehicleController@create')->name('vehicles.create');
  Route::post('/vehicles', 'VehicleController@store')->name('vehicles.store');
  Route::get('/vehicles/{vehicle}', 'VehicleController@show')->name('vehicles.show');
  Route::get('/vehicles/{vehicle}/edit', 'VehicleController@edit')->name('vehicles.edit');
  Route::put('/vehicles/{vehicle}', 'VehicleController@update')->name('vehicles.update');
  Route::delete('/vehicles/{vehicle}', 'VehicleController@destroy')->name('vehicles.destroy');

  Route::get('/announcements', 'AnnouncementController@index')->name('announcements.index');
  //  Route::get('/announcements.getAll', 'AnnouncementController@getAnnouncements')->name('announcements.get');
  Route::get('/announcements/{announcement}', 'AnnouncementController@show')->name('announcements.show');
  Route::get('/announcements/create', 'AnnouncementController@create')->name('announcements.create');
  Route::post('/announcements', 'AnnouncementController@store')->name('announcements.store');
  Route::get('/announcements/{announcement}/edit', 'AnnouncementController@edit')->name('announcements.edit');
  Route::put('/announcements/{announcement}', 'AnnouncementController@update')->name('announcements.update');
  Route::get('/announcements/{announcement}', 'AnnouncementController@destroy');

  Route::get('/faqs', 'FaqsController@index')->name('faqs.index');

  Route::get('/orders', 'OrderController@index')->name('order.index');
  Route::get('/orders/{order}', 'OrderController@show')->name('order.show');
  Route::get('/orders/{order}/edit', 'OrderController@edit')->name('order.edit');
  Route::get('/orders/{vehicle}/rent', 'OrderController@create')->name('order.create');
  Route::post('/orders/create', 'OrderController@store')->name('order.store');
  Route::put('/orders/{order}', 'OrderController@update')->name('order.update');
});
Route::get('/user-register', 'UserController@create');
Route::post('/user-register', 'UserController@store')->name('userregister');
