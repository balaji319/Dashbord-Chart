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
            $report_month = "11";//$request->report_month;
            $report_year = "2018";//$request->report_year;
            $campaign_number = "1376";//$request->campaign_number;
            $info = cal_days_in_month(CAL_GREGORIAN,$report_month,$report_year);
            $start_date= "$report_month/1/$report_year";
            $end_date= "$report_month/$info/$report_year";
            echo "<pre/>";
            
            /*$sql = "SELECT COUNT(*) AS completed FROM HangUps WHERE hangupdate BETWEEN '".$start_date."' AND '".$end_date."' AND (CompanyID =  '".session('user_info')->CompanyID."') AND (CampaignID = '".$campaign_number."') and hangupcount = 2 GROUP BY convert(varchar, hangupdate, 101) ";
            $completed = DB::select($sql);
            
            $sql = "SELECT COUNT(*) AS total FROM HangUps WHERE hangupdate BETWEEN '".$start_date."' AND '".$end_date."' AND (CompanyID =  '".session('user_info')->CompanyID."') AND (CampaignID = '".$campaign_number."')  GROUP BY convert(varchar, hangupdate, 101) ";
            $total = DB::select($sql);
            print_r($completed);
            print_r($total);die;*/
            
            /*echo $sql = "SELECT convert(varchar, hangupdate, 101)as hangupdate, hangupcount FROM HangUps WHERE hangupdate BETWEEN '".$start_date."' AND '".$end_date."' AND (CompanyID =  '".session('user_info')->CompanyID."') AND (CampaignID = '".$campaign_number."') Order BY hangupdate ";
            $total = DB::select($sql);
            $result = array_map(function ($value) {
                return (array)$value;
            }, $total);
            $colors = array_count_values(array_column($result, 'hangupdate'));
            $colors = array_count_values(array_column($result, 'hangupcount'));
            print_r($colors);die;
            $materials = array_count_values(array_column($arr, 1));
            */
            /*$arr = [];
            for($i = 1;$i<$info;$i++) {
                $day = "$report_month/$i/$report_year";
                echo $sql = "SELECT convert(varchar, hangupdate, 101)as hangupdate, hangupcount FROM HangUps WHERE convert(varchar, hangupdate, 101) = '".$day."' AND (CompanyID =  '".session('user_info')->CompanyID."') AND (CampaignID = '".$campaign_number."') ";
                $total = DB::select($sql);
                print_r($total);die;
                $arr[$i]['day'] = $day .'-'. date('l', strtotime($day));
                $arr[$i]['total'] = $total[$i -1 ]->total;
                $arr[$i]['completed'] = $completed[$i - 1]->completed;
            }
            print_r($arr);die;*/
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
