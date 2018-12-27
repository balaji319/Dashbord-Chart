<?php

namespace App\Http\Controllers\Api\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;

class ReportController extends Controller {

    public function executiveReport(Request $request) {
        try {
            $response = Report::executiveReport($request);
            return response()->json([
                        'status' => 200,
                        'message' => 'Success',
                        'data' => $response,
                            ], 200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
