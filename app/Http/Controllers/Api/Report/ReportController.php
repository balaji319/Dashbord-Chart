<?php

namespace App\Http\Controllers\Api\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use DB;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

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
    
    
    public function statistics(Request $request) {
        try {
            $current_time = date('m/d/Y');
            $seven_day = date('m/d/Y', strtotime('-7 days'));
            $fourteen_day = date('m/d/Y', strtotime('-14 days'));
            $twenty_one_day = date('m/d/Y', strtotime('-21 days'));
            
            $sql = "SELECT COUNT(HangUps.hangupid) AS CallCount, day(HangUps.hangupdate) CallDate,CONVERT(CHAR(10), HangUps.hangupdate, 101) as hangupdate
                FROM HangUps INNER JOIN Campaigns ON HangUps.CampaignID = Campaigns.CampaignID WHERE HangUps.CompanyID = '".session('user_info')->CompanyID."' 
                AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) > '".$seven_day."' AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) <= '".$current_time."'
                GROUP BY day(HangUps.hangupdate),CONVERT(CHAR(10), HangUps.hangupdate, 101)
                Order By day(HangUps.hangupdate)";
            $last_week = DB::select($sql);
            foreach ($last_week as $k => $v){
                $week_array[] = $v->CallCount;
            }
         
            $sql = "SELECT COUNT(HangUps.hangupid) AS CallCount, day(HangUps.hangupdate) CallDate,CONVERT(CHAR(10), HangUps.hangupdate, 101) as hangupdate
                FROM HangUps INNER JOIN Campaigns ON HangUps.CampaignID = Campaigns.CampaignID WHERE HangUps.CompanyID = '".session('user_info')->CompanyID."' 
                AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) > '".$fourteen_day."' AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) <= '".$seven_day."'
                GROUP BY day(HangUps.hangupdate),CONVERT(CHAR(10), HangUps.hangupdate, 101)
                Order By day(HangUps.hangupdate)";
            $last_fourteen = DB::select($sql);
            foreach ($last_fourteen as $k => $v){
                $fourteen_array[] = $v->CallCount;
            }
            
            $sql = "SELECT COUNT(HangUps.hangupid) AS CallCount, day(HangUps.hangupdate) CallDate,CONVERT(CHAR(10), HangUps.hangupdate, 101) as hangupdate
                FROM HangUps INNER JOIN Campaigns ON HangUps.CampaignID = Campaigns.CampaignID WHERE HangUps.CompanyID = '".session('user_info')->CompanyID."' 
                AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) > '".$twenty_one_day."' AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) <= '".$fourteen_day."'
                GROUP BY day(HangUps.hangupdate),CONVERT(CHAR(10), HangUps.hangupdate, 101)
                Order By day(HangUps.hangupdate)";
            $twenty_one = DB::select($sql);
            foreach ($twenty_one as $k => $v){
                $twenty_one_array[] = $v->CallCount;
                $days_array[] = date('l', strtotime($v->hangupdate));
            }
            
            $arr = ["days_array"=>$days_array,"week_array"=>$week_array,"fourteen_array"=>$fourteen_array,"twenty_one_array"=>$twenty_one_array];
           
            return response()->json([ 'status' => 200, 'message' => 'Success', 'data' => $arr ], 200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    public function topCities(Request $request) {
        try {
            $startdate = $request->startdate;
            $enddate = $request->enddate;
            if (empty($startdate)) {
                $startdate = date('m/01/Y');
            }
            if (empty($enddate)) {
                $enddate = date('m/d/Y');
            }
            $current_time = date('m/d/Y');
            $sql = "SELECT     TOP 25 COUNT(*) AS CallCount, City + ', ' + State AS City
                FROM         IVRTranscriptions
                WHERE     (IVRTranscriptions.GroupNumber <> 'web')
                 AND (IVRTranscriptions.City IS NOT NULL AND IVRTranscriptions.City <> '') AND
                IVRTranscriptions.CompanyID = '".session('user_info')->CompanyID."'
                AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) >= '".$startdate."' 
                AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) <= '".$enddate." 11:59 PM'
                GROUP BY City + ', ' + State
                ORDER BY COUNT(*) DESC";
            $top_city = DB::select($sql);
            foreach ($top_city as $k => $v){
                $top_cities['CallCount'][] = $v->CallCount;;
                $top_cities['City'][] = $v->City;
            }
            
            return response()->json([ 'status' => 200, 'message' => 'Success', 'data' => $top_cities ], 200);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    public function countriesStationBreakdown(Request $request) {
        try {
            $month = $request->month;
            $year = $request->year;
            if (empty($month)) {
                $month = date('m');
            }
            if (empty($year)) {
                $year = date('Y');
            }
            $date = cal_days_in_month(CAL_GREGORIAN,$month,$year);
            $now_date= "$month/$year";
            if($now_date == date("m/Y")){
                $date = date('d');
            }
            $start_date = "$month/01/$year";
            $end_date = "$month/$date/$year";
            
            $sql = "SELECT Geography FROM Campaigns where CompanyID1 = '".session('user_info')->CompanyID."' and geography <> 'unknown' group by Geography Order By Geography";
            $geography = DB::select($sql);
            $str = "";
            foreach ($geography as $k => $v) {
                $str.= "'".$v->Geography."',";
            }
            $geogra = rtrim($str,',');
            
            $sql = "SELECT count(*) as Calls, Name
                    FROM HangUps INNER JOIN
                    Campaigns ON HangUps.CampaignID = Campaigns.CampaignID
                    where CompanyID = '".session('user_info')->CompanyID."'  AND Hangupdate >= '".$start_date."'
                    AND Hangupdate < '".$end_date."'
                    and Campaigns.Geography IN (".$geogra.") 
                    Group by Name";
            $summery = DB::select($sql);
    
            return response()->json([ 'status' => 200, 'message' => 'Success', 'data' => $summery ], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }
    
    
}
