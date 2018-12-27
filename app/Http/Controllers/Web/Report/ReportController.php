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
        return view('reports.executivecallsummary');
    }

    public function staticalSummary() {
        return view('reports.executivecallsummary');
    }
}
