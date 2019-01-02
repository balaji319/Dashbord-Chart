<?php

namespace App\Http\Controllers\Web\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallDataController extends Controller
{
    //


    public function downloadData() {
    $files = [];
    $filesize = [];
    $filesInFolder = \File::files('Files/localuser');
    foreach($filesInFolder as $path)
        {
            $files[] = pathinfo($path);
            $filesize[] = round(filesize($path) / 1024, 2);

        }
            return view('calldata.downloaddata',compact('files','filesize'));
        }


    public function callRecording() {
        return view('calldata.callrecording');
    }

}
