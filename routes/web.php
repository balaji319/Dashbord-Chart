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

/*
  |--------------------------------------------------------------------------
  | Register and Login Routes
  |--------------------------------------------------------------------------
 */
Route::get('/', 'UserController@login');
Route::get('login', 'UserController@login')->name('login');
Route::post('/login', 'UserController@loginApi');
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

Route::group(['middleware' => ['userAuth'], ['namespace' => 'Web']], function() {
      /*
    |--------------------------------------------------------------------------
    |  Report Routes
    |--------------------------------------------------------------------------
    */
    Route::get('exe-summary', 'Web\Report\ReportController@exeSummary');
    Route::get('network-summary', 'Web\Report\ReportController@networkCallSummary');
    Route::get('statical-summary', 'Web\Report\ReportController@staticalSummary');
    Route::get('web-summary', 'Web\Report\ReportController@webSummary');
    Route::get('topcities', 'Web\Report\ReportController@topCities');
    Route::get('topcountries', 'Web\Report\ReportController@topCountries');
    Route::get('stats-countries', 'Web\Report\ReportController@statsCountries');
    Route::get('top-prayers', 'Web\Report\ReportController@topPrayers');
    Route::get('gender-break', 'Web\Report\ReportController@genderBreak');
    Route::get('minute-log', 'Web\Report\ReportController@minuteLog');
    Route::get('hour-log', 'Web\Report\ReportController@hourLog');
    Route::get('map-calls', 'Web\Report\ReportController@mapCalls');
    Route::get('hourly168', 'Web\Report\ReportController@hourly168');



 /*
    |--------------------------------------------------------------------------
    | CallData Report Routes
    |--------------------------------------------------------------------------
    */
    Route::get('downloaddata', 'Web\Report\CallDataController@downloadData');
    Route::get('callrecording', 'Web\Report\CallDataController@callRecording');

 /*
    |--------------------------------------------------------------------------
    | Administrator Report Routes
    |--------------------------------------------------------------------------
    */
    Route::get('activenumbers', 'Web\Report\AdministratorController@activeNumbers');
    Route::get('requestnumber', 'Web\Report\AdministratorController@requestNumber');
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
    /*
    |--------------------------------------------------------------------------
    | 7 Day call camparison route
    |--------------------------------------------------------------------------
    */
    Route::get('call/comparison', 'Api\Report\CallController@callComparison');
    /*
    |--------------------------------------------------------------------------
    | Hourly log route
    |--------------------------------------------------------------------------
    */
    Route::get('hourly/log', 'Api\Report\CallController@hourlyLog');
    Route::get('campaigns/option-list', 'Api\Report\CallController@campaignsOptionList');
    /*
    |--------------------------------------------------------------------------
    | Minute log route
    |--------------------------------------------------------------------------
    */
    Route::get('minute/log', 'Api\Report\CallController@minuteLog');
    /*
    |--------------------------------------------------------------------------
    | Top player route
    |--------------------------------------------------------------------------
    */
    Route::get('top-player', 'Api\Report\PlayerController@topPlayer');

});

/**
 * Report tabs route.
 */
Route::group(['middleware' => ['userAuth'], ['namespace' => 'Api']], function() {
    Route::post('executive-report', 'Api\Report\ReportController@executiveReport');
    Route::get('details-executive-report', 'Api\Report\ReportController@detailsExecutiveReport');
    Route::get('campaign-list', 'Api\Report\ReportController@campaignList');
    Route::get('network-reports', 'Api\Report\ReportController@networkReports');
    Route::get('statistics', 'Api\Report\ReportController@statistics');
    Route::get('website-summery', 'Api\Report\ReportController@websiteSummery');
    Route::get('top-cities', 'Api\Report\ReportController@topCities');
    Route::get('top-countries', 'Api\Report\ReportController@topCountries');
    Route::get('country-mtd', 'Api\Report\ReportController@countriesStationBreakdown');
    Route::get('downoad', 'Api\Report\ReportController@downoad');
    Route::get('google-map', 'Api\Report\ReportController@googleMap');
    Route::get('gender-report', 'Api\Report\ReportController@genderReport');
});


/**
 * Call Data tabs route.
 */
Route::group(['middleware' => ['userAuth'], ['namespace' => 'Api']], function() {
    Route::get('call-recording', 'Api\Report\ReportController@callRecording');
    Route::get('call-recording-file', 'Api\Report\ReportController@callRecordingFile');
    Route::get('call-recording-email', 'Api\Report\ReportController@callRecordingDetails');
});


/**
 * Call Data tabs route.
 */
Route::group(['middleware' => ['userAuth'], ['namespace' => 'Api']], function() {
    Route::get('active-numbers', 'Api\Report\ReportController@activeNumbers');
    Route::get('request-number', 'Api\Report\ReportController@requestNumber');
});



Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');