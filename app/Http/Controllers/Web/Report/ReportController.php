<?php

namespace App\Http\Controllers\Web\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{

    public function exeSummary() {
        return view('reports.executivecallsummary');
    }

    public function networkCallSummary() {
        return view('reports.networkcallsummary');
    }

    public function staticalSummary() {
        return view('reports.statisticshistory');
    }

    public function webSummary() {
        return view('reports.websitetrans');
    }

    public function topCities() {
        return view('reports.topcities');
    }

    public function topCountries () {
        return view('reports.topcountry');
    }

    public function statsCountries() {
        return view('reports.countrybreakdown');
    }

    public function topPrayers() {
        return view('reports.topprayers');
    }

    public function genderBreak() {
        return view('reports.genderreport');
    }

    public function minuteLog() {
        return view('reports.minutelogger');
    }

    public function hourLog() {
        return view('reports.hourlybreakdown');
    }

    public function mapCalls () {
        return view('reports.mapscalls');
    }
    public function hourly168 () {
        return view('reports.hourly168');
    }




}
