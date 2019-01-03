<?php

namespace App\Http\Controllers\Api\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use DB;

class CallController extends Controller
{

    /**
     * 7 Day call comparison
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Http\Controllers\Api\Report\Exception
     */
    public function callComparison(Request $request)
    {
        try {

            $company_id = session('user_info')->CompanyID;
            $start_date = $request->get('start_date', NULL);

            if($start_date == NULL){
                $start_date = Carbon::today()->toDateTimeString();
            }else{
                $start_date = Carbon::parse($start_date)->toDateTimeString();
            }
            
            $results['todays']['color'] = 'gray';
            $results['todays']['date'] = $start_date;
            $results['before_seven_days']['color'] = 'red';
            $results['before_seven_days']['date'] = Carbon::parse($start_date)->subDays(7)->toDateTimeString();
            $results['before_fourteen_days']['color'] = 'green';
            $results['before_fourteen_days']['date'] = Carbon::parse($start_date)->subDays(14)->toDateTimeString();

            for($i=0; $i<24; $i++){

                $first_day = DB::table('hangups')->where('CompanyID', $company_id);
                $first_start_date = Carbon::parse($start_date)->addHours($i)->toDateTimeString();
                $first_end_date = Carbon::parse($start_date)->addHours($i+1)->toDateTimeString();
                $first_date_array = [$first_start_date, $first_end_date];
                $first_day_count = $first_day->whereBetween('hangups.hangupdate', $first_date_array)->count('hangupid');
                $results['todays']['data'][] = $first_day_count;

                $seven_day = DB::table('hangups')->where('CompanyID', $company_id);
                $before_7_satrt_date = Carbon::parse($start_date)->subDays(7)->addHours($i)->toDateTimeString();
                $before_7_end_date = Carbon::parse($start_date)->subDays(7)->addHours($i+1)->toDateTimeString();
                $before_7_date_array = [$before_7_satrt_date, $before_7_end_date];
                $before_7_day_count = $seven_day->whereBetween('hangups.hangupdate', $before_7_date_array)->count('hangupid');
                $results['before_seven_days']['data'][] = $before_7_day_count;

                $fourteen_day = DB::table('hangups')->where('CompanyID', $company_id);
                $before_14_satrt_date = Carbon::parse($start_date)->subDays(14)->addHours($i)->toDateTimeString();
                $before_14_end_date = Carbon::parse($start_date)->subDays(14)->addHours($i+1)->toDateTimeString();
                $before_14_date_array = [$before_14_satrt_date, $before_14_end_date];
                $before_14_day_count = $fourteen_day->whereBetween('hangups.hangupdate', $before_14_date_array)->count('hangupid');
                $results['before_fourteen_days']['data'][] = $before_14_day_count;
            }

            return response()->json(['status' => 200, 'data' => $results]);
        } catch (Exception $ex) {            
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }
    
    /**
     * Campaigns option List
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function campaignsOptionList(Request $request)
    {
        try {

            $company_id = session('user_info')->CompanyID;
            $campaigns_list = DB::table('Campaigns')
                    ->select('Name', 'campaignID')
                    ->where('CompanyID1', $company_id)
                    ->orderBy('Name', 'asc')
                    ->get();
            return response()->json(['status' => 200, 'data' => ['campaigns' => $campaigns_list]]);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    /**
     * Hourly log
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function hourlyLog(Request $request)
    {
        try {

            $results = [];
            $company_id = session('user_info')->CompanyID;
            $campaign_id = $request->get('campaign_id', NULL);
            $start_date = $request->get('start_date', NULL);

            if($start_date == NULL){
                $start_date = Carbon::today();
            }else{
                $start_date = Carbon::parse($start_date);
            }
            $date_array = [$start_date->toDateTimeString(), $start_date->addHours(24)->toDateTimeString()];

            $hangups = DB::table('hangups')
                            ->selectRaw('Campaigns.Name, Campaigns.CampaignID, COUNT(hangups.hangupid) AS Expr1')
                            ->join('Campaigns', 'hangups.CampaignID', '=','Campaigns.CampaignID')
                            ->where('hangups.CompanyID', $company_id)
                            ->where('Campaigns.CampaignID', $campaign_id)
                            ->whereBetween('hangupdate', $date_array)
                            ->groupBy('Campaigns.Name')
                            ->groupBy('Campaigns.CampaignID')
                            ->get();
            $results['hangup'] = $hangups;

            for($i=0; $i<24; $i++){
                $start_date_temp = Carbon::parse($start_date)->addHours($i)->toDateTimeString();
                $end_date = Carbon::parse($start_date)->addHours($i+1)->toDateTimeString();
                $date_array = [$start_date_temp, $end_date];
                $count = DB::table('hangups')
                                ->join('Campaigns', 'hangups.CampaignID', '=','Campaigns.CampaignID')
                                ->where('hangups.CompanyID', $company_id)
                                ->where('Campaigns.CampaignID', $campaign_id)
                                ->whereBetween('hangups.hangupdate', $date_array)
                                ->groupBy('Campaigns.Name')
                                ->count('hangups.hangupid');
                $results['hangups_data'][] = $count;
            }

            return response()->json(['status' => 200, 'data' => $results]);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

     /**
     * Minute log
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function minuteLog(Request $request)
    {
        try {

            $results = [];
            $company_id = session('user_info')->CompanyID;
            $start_date = $request->get('start_date', NULL);
            $campaign_id = $request->get('campaign_id', NULL);
            $start_time = (int) $request->get('start_time', 0);
            $end_time = $start_time + 1;

            if($start_date == NULL){
                $start_date = Carbon::today();
            }else{
                $start_date = Carbon::parse($start_date);
            }

            //Current day
            $first_day_date = $start_date->format('m/d/Y');
            $query = "SELECT { fn HOUR(hangups.hangupdate) } AS HourTime, { fn MINUTE(hangups.hangupdate) } AS MinuteTime, { fn HOUR(hangups.hangupdate) } AS ScheduleHour,
                COUNT(hangups.hangupid) AS totalCount FROM hangups
                WHERE CONVERT(varchar(24), hangups.hangupdate, 101) = '$first_day_date'
                AND { fn HOUR(hangups.hangupdate) } >= '$start_time'
                AND { fn HOUR(hangups.hangupdate) } < '$end_time'
                AND companyid = $company_id";
            if($campaign_id != 0 && $campaign_id != NULL){
                $query .= " AND campaignID = $campaign_id";
            }
            $query .= " GROUP BY { fn HOUR(hangups.hangupdate) }, { fn MINUTE(hangups.hangupdate) }, CONVERT(varchar(24), hangups.hangupdate, 101)";
            $first_day = DB::select($query);

            $minute_array = array_column($first_day, 'MinuteTime');
            $count_array = array_column($first_day, 'totalCount');

            $first_day_res = [];
            for($i= 0; $i<60; $i++){
                if(in_array($i, $minute_array)){
                    $key = array_search($i, $minute_array);
                    $first_day_res[] = (int) $count_array[$key];
                }else{
                    $first_day_res[] = 0;
                }
            }
            $results['first_day']['color'] = 'gray';
            $results['first_day']['date'] = $first_day_date;
            $results['first_day']['data'] = $first_day_res;

            // Before 7 days
            $befor_seven_days_date = date('m/d/Y', strtotime('-7 days'));
            $query = "SELECT { fn HOUR(hangups.hangupdate) } AS HourTime, { fn MINUTE(hangups.hangupdate) } AS MinuteTime, { fn HOUR(hangups.hangupdate) } AS ScheduleHour,
                COUNT(hangups.hangupid) AS totalCount FROM hangups
                WHERE CONVERT(varchar(24), hangups.hangupdate, 101) = '$befor_seven_days_date'
                AND { fn HOUR(hangups.hangupdate) } >= '$start_time'
                AND { fn HOUR(hangups.hangupdate) } < '$end_time'
                AND companyid = $company_id";
            if($campaign_id != 0 && $campaign_id != NULL){
                $query .= " AND campaignID = $campaign_id";
            }
            $query .= " GROUP BY { fn HOUR(hangups.hangupdate) }, { fn MINUTE(hangups.hangupdate) }, CONVERT(varchar(24), hangups.hangupdate, 101)";
            $befor_seven_days = DB::select($query);

            $minute_array = array_column($befor_seven_days, 'MinuteTime');
            $count_array = array_column($befor_seven_days, 'totalCount');

            $befor_seven_days_res = [];
            for($i= 0; $i<60; $i++){
                if(in_array($i, $minute_array)){
                    $key = array_search($i, $minute_array);
                    $befor_seven_days_res[] = (int) $count_array[$key];
                }else{
                    $befor_seven_days_res[] = 0;
                }
            }
            $results['befor_seven_days']['color'] = 'red';
            $results['befor_seven_days']['date'] = $befor_seven_days_date;
            $results['befor_seven_days']['data'] = $befor_seven_days_res;

            // Before 14 days
            $befor_forteen_days_date = date('m/d/Y', strtotime('-14 days'));
            
            $query = "SELECT { fn HOUR(hangups.hangupdate) } AS HourTime, { fn MINUTE(hangups.hangupdate) } AS MinuteTime, { fn HOUR(hangups.hangupdate) } AS ScheduleHour,
                COUNT(hangups.hangupid) AS totalCount FROM hangups
                WHERE CONVERT(varchar(24), hangups.hangupdate, 101) = '$befor_forteen_days_date'
                AND { fn HOUR(hangups.hangupdate) } >= '$start_time'
                AND { fn HOUR(hangups.hangupdate) } < '$end_time'
                AND companyid = $company_id";
            if($campaign_id != 0 && $campaign_id != NULL){
                $query .= " AND campaignID = $campaign_id";
            }
            $query .= " GROUP BY { fn HOUR(hangups.hangupdate) }, { fn MINUTE(hangups.hangupdate) }, CONVERT(varchar(24), hangups.hangupdate, 101)";
            $befor_forteen_days = DB::select($query);

            $minute_array = array_column($befor_forteen_days, 'MinuteTime');
            $count_array = array_column($befor_forteen_days, 'totalCount');

            $befor_forteen_days_res = [];
            for($i= 0; $i<60; $i++){
                if(in_array($i, $minute_array)){
                    $key = array_search($i, $minute_array);
                    $befor_forteen_days_res[] = (int) $count_array[$key];
                }else{
                    $befor_forteen_days_res[] = 0;
                }
            }
            $results['befor_forteen_days']['color'] = 'green';
            $results['befor_forteen_days']['date'] = $befor_forteen_days_date;
            $results['befor_forteen_days']['data'] = $befor_forteen_days_res;

            // Before 21 days
            $befor_twenty_one_days_date = date('m/d/Y', strtotime('-21 days'));
            $query = "SELECT { fn HOUR(hangups.hangupdate) } AS HourTime, { fn MINUTE(hangups.hangupdate) } AS MinuteTime, { fn HOUR(hangups.hangupdate) } AS ScheduleHour,
                COUNT(hangups.hangupid) AS totalCount FROM hangups
                WHERE CONVERT(varchar(24), hangups.hangupdate, 101) = '$befor_twenty_one_days_date'
                AND { fn HOUR(hangups.hangupdate) } >= '$start_time'
                AND { fn HOUR(hangups.hangupdate) } < '$end_time'
                AND companyid = $company_id";
            if($campaign_id != 0 && $campaign_id != NULL){
                $query .= " AND campaignID = $campaign_id";
            }
            $query .= " GROUP BY { fn HOUR(hangups.hangupdate) }, { fn MINUTE(hangups.hangupdate) }, CONVERT(varchar(24), hangups.hangupdate, 101)";
            $befor_twenty_one_days = DB::select($query);

            $minute_array = array_column($befor_twenty_one_days, 'MinuteTime');
            $count_array = array_column($befor_twenty_one_days, 'totalCount');

            $befor_twenty_one_days_res = [];
            for($i= 0; $i<60; $i++){
                if(in_array($i, $minute_array)){
                    $key = array_search($i, $minute_array);
                    $befor_twenty_one_days_res[] = (int) $count_array[$key];
                }else{
                    $befor_twenty_one_days_res[] = 0;
                }
            }
            $results['befor_twenty_one_days']['color'] = 'yellow';
            $results['befor_twenty_one_days']['date'] = $befor_twenty_one_days_date;
            $results['befor_twenty_one_days']['data'] = $befor_twenty_one_days_res;
            
            return response()->json(['status' => 200, 'data' => $results]);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }


}
