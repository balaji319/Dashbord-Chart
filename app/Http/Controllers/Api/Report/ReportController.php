<?php

namespace App\Http\Controllers\Api\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use DB;
use Session;

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
    
    public function detailsExecutiveReport(Request $request) {
        try {
            $response = Report::detailsExecutiveReport($request);
            return response()->json([
                        'status' => 200,
                        'message' => 'Success',
                        'data' => $response,
                        ], 200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function campaignList(Request $request) {
        try {
            $sql = "SELECT Campaign,CampaignID,Name FROM Campaigns where isactive = 1 and CompanyId1 = '" . session('user_info')->CompanyID . "' and Name <> 'AVAILABLE' Order by Name";
            $info = DB::select($sql);
            return response()->json([
                        'status' => 200,
                        'message' => 'Success',
                        'data' => $info,
                        ], 200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    
    public function networkReports(Request $request) {
        try {
            $report_month = $request->report_month;
            $report_year = $request->report_year;
            $campaign_number = $request->campaign_number;
            if(empty($report_month) || empty($report_year) || empty($campaign_number)) {
                return response()->json([ 'status' => 400, 'message' => 'Please enter all details.', ], 400);
            }
            $info = cal_days_in_month(CAL_GREGORIAN,$report_month,$report_year);
            $start_date= "$report_month/1/$report_year";
            $end_date= "$report_month/$info/$report_year";
            
            $arr = [];
            for($i = 1;$i<=$info;$i++) {
                $day = "$report_month/".str_pad($i, 2, "0", STR_PAD_LEFT)."/$report_year";
                $arr[$i]['day'] = $day .'-'. date('l', strtotime($day));
                
                $sql = "SELECT COUNT(*) AS total FROM HangUps WHERE convert(varchar, hangupdate, 101) = '".$day."' AND (CompanyID =  '".session('user_info')->CompanyID."') AND (CampaignID = '".$campaign_number."') ";
                $total = DB::select($sql);
                $arr[$i]['total'] = $total[0]->total;
                
                $sql = "SELECT COUNT(*) AS completed FROM HangUps WHERE convert(varchar, hangupdate, 101) = '".$day."' AND (CompanyID =  '".session('user_info')->CompanyID."') AND (CampaignID = '".$campaign_number."') and hangupcount = 2";
                $completed = DB::select($sql);
                $arr[$i]['completed'] = $completed[0]->completed;
            
            }
            
            return response()->json([
                        'status' => 200,
                        'message' => 'Success',
                        'data' => $arr,
                        ], 200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    
}
