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

/* Route::get('/', function () {
  return view('login');
  }); */
/*
  |--------------------------------------------------------------------------
  | Register and Login Routes
  |--------------------------------------------------------------------------
 */
Route::group([], function() {

    Route::get('login', 'UserController@login')->name('login');

    Route::get('/', 'UserController@login');

    Route::post('/login', 'UserController@loginApi');
});


Route::get('/', 'UserController@login');
Route::get('login', 'UserController@login');


Route::get('my-users', 'UserController@myUsers');
Route::get('logout', 'UserController@logout');

/*
  |--------------------------------------------------------------------------
  | Report  Routes
  |--------------------------------------------------------------------------
 */
/**
 * all routes.
 * @author Balaji  .
 */
Route::group(['namespace' => 'Web'], function() {

    Route::get('exe-summary', 'Report\ReportController@exeSummary');
    Route::get('network-summary', 'Report\ReportController@networkCallSummary');
    Route::get('statical-summary', 'Report\ReportController@staticalSummary');
    Route::get('web-summary', 'Report\ReportController@webSummary');
    Route::get('top-cities', 'Report\ReportController@topCities');
    Route::get('top-countries', 'Report\ReportController@topCountries');
    Route::get('stats-countries', 'Report\ReportController@statsCountries');
    Route::get('top-prayers', 'Report\ReportController@topPrayers');
    Route::get('gender-break', 'Report\ReportController@genderBreak');
    Route::get('minute-log', 'Report\ReportController@minuteLog');
    Route::get('hour-log', 'Report\ReportController@hourLog');
    Route::get('map-calls', 'Report\ReportController@mapCalls');
    Route::get('hourly168', 'Report\ReportController@hourly168');
});



/**
 * User Dashboard api.
 * @author Harshal Pawar. <harshal.pawar@ytel.co.in>
 */
Route::group(['middleware' => ['userAuth']], function() {
    Route::get('my-home', 'UserController@myHome');
    Route::get('advert-spikes-past-hour', 'Api\Report\HomeController@advertSpikesPastHour');
    Route::get('hourly-calls', 'Api\Report\HomeController@hourlyCalls');
    Route::get('most-recent-calls', 'Api\Report\HomeController@mostRecentCalls');
    Route::get('top-active-numbers', 'Api\Report\HomeController@topActiveNumbers');
});

/**
 * Report tabs route.
 */
Route::group(['middleware' => ['userAuth'], ['namespace' => 'Api']], function() {
    Route::post('executive-report', 'Api\Report\ReportController@executiveReport');
    Route::get('details-executive-report', 'Api\Report\ReportController@detailsExecutiveReport');
    
    Route::get('campaign-list', 'Api\Report\ReportController@campaignList');
    Route::get('network-reports', 'Api\Report\ReportController@networkReports');
    
});