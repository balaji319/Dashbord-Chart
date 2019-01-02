<?php

namespace App\Http\Controllers\Web\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallDataController extends Controller
{
    //


    public function downloadData() {
    $manuals = [];
    $manuals1 = [];
    $filesInFolder = \File::files('manual');
    foreach($filesInFolder as $path)
        {
            $manuals[] = pathinfo($path);
            $manuals1[] = round(filesize($path) / 1024, 2);

        }
            return view('calldata.downloaddata',compact('manuals','manuals1'));
        }


    public function callRecording() {
        return view('calldata.callrecording');
    }

}
