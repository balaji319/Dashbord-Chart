<?php

namespace App\Http\Controllers\Api\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Home;
use Session;

class HomeController extends Controller
{

    /**
     * Home page Advert Spikes Past Hour.
     * @param Request $request
     * @return type
     * @throws \App\Http\Controllers\Exception
     */
    public function advertSpikesPastHour(Request $request) {
        try {
        	$response = Home::advertSpikesPastHour();
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $response,
            ],200);

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Home page last 24 hours calls.
     * @param Request $request
     * @return type
     * @throws \App\Http\Controllers\Exception
     */
    public function hourlyCalls(Request $request) {
        try {
            $response = Home::hourlyCalls();
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $response,
            ],200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function mostRecentCalls(Request $request) {
        try {
            
            $response = Home::mostRecentCalls();
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $response,
            ],200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function topActiveNumbers(Request $request) {
        try {
            $response = Home::topActiveNumbers();
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $response,
            ],200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}

