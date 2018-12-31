<?php

namespace App\Http\Controllers\Web\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    public function activeNumbers() {
        return view('administrator.activenumbers');
    }


    public function requestNumber() {
        return view('administrator.requestnumber');
    }

}
