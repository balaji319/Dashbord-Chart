<?php

namespace App\Http\Controllers\Web\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallDataController extends Controller
{
    //

    
    public function downloadData() {
        return view('callData.downloaddata');
    }


    public function callRecording() {
        return view('callData.callrecording');
    }

}
