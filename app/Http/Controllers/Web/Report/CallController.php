<?php

namespace App\Http\Controllers\Web\Report;

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
    
    public function hourlyLog(Request $request)
    {
        try {

            $results = [];
            $company_id = $request->get('company_id', NULL);
            $start_date = $request->get('start_date', NULL);

            if($start_date == NULL){
                $start_date = Carbon::today();
            }else{
                $start_date = Carbon::parse($start_date);
            }
            $date_array = [$start_date->toDateTimeString(), $start_date->addHours(24)->toDateTimeString()];
//            SELECT campaignID,Name
//FROM Campaigns WHERE CompanyID1 = #getauth.companyid# #StationFilter#
//Order By Name
            $campaigns = DB::table('Campaigns')->select('campaignID', 'Name')
                    ->where('CompanyID1', $company_id)
                    ->orderBy('Name')
                    ->get();
            dd($campaigns);
//            SELECT     Campaigns.Name,Campaigns.CampaignID, COUNT(hangups.hangupid) AS Expr1
//FROM         hangups INNER JOIN
//                      Campaigns ON hangups.CampaignID = Campaigns.CampaignID
//WHERE     (hangups.CompanyID = #getauth.companyid#) AND (hangupdate >= '#SelectedDate1# 12:00 AM') and Campaigns.CampaignID = '#CampaignID1#' 
//and <cfif SelectedDate1 EQ DateFormat(now(),'MM/DD/YYYY')>hangupdate < '#dateformat(now(), 'MM/DD/YYYY')# #timeformat(now(), 'hh:mm:ss tt')#'
//<cfelse>
//(hangupdate < '#SelectedDate1# 11:59:59 PM')
//</cfif>
//GROUP BY Campaigns.Name,Campaigns.CampaignID
            $hangups = DB::table('hangups')->selectRaw('Campaigns.Name, Campaigns.campaignID, COUNT(hangups.hangupid) AS Expr1')
                    ->join('Campaigns', 'hangups.CampaignID', 'Campaigns.campaignID')
                    ->where('hangups.CompanyID', $company_id)
                    ->where('Campaigns.CampaignID', $company_id)
//                    ->whereBetween('hangupdate', $date_array)
                    ->groupBy('Campaigns.Name')
//                    ->groupBy('Campaigns.CampaignID')
                    ->first();
            dd($hangups);
//            SELECT     COUNT(hangups.hangupid) AS totalCount, Campaigns.Name
//FROM         hangups INNER JOIN
//                      Campaigns ON  hangups.CampaignID = Campaigns.CampaignID
//WHERE     (hangups.hangupdate >= '#SelectedDate1# 12:00 AM') AND  (Campaigns.CampaignID= #getCamps.CampaignID#)
//and <cfif SelectedDate1 EQ DateFormat(now(),'MM/DD/YYYY')>hangupdate < '#dateformat(now(), 'MM/DD/YYYY')# #timeformat(now(), 'hh:mm:ss tt')#'
//<cfelse>
//(hangupdate < '#SelectedDate1# 11:59:59 PM')
//</cfif>
//AND { fn HOUR(hangups.hangupdate) } = #i# AND hangups.CompanyID = #getauth.companyid#
//GROUP BY { fn HOUR(hangups.hangupdate) }, Campaigns.Name
            
            $hangups_campaigns = DB::table('hangups')->selectRaw('COUNT(hangups.hangupid) AS totalCount, Campaigns.Name')
                    ->join('Campaigns', 'hangups.CampaignID', 'Campaigns.CampaignID')
                    ->where('Campaigns.CampaignID', $company_id);
            for($i=0; $i<24; $i++){
                $first_start_date = Carbon::parse($start_date)->addHours($i)->toDateTimeString();
                $first_end_date = Carbon::parse($start_date)->addHours($i+1)->toDateTimeString();
                $first_date_array = [$first_start_date, $first_end_date];
                $first_day_count = $first_day->whereBetween('hangups.hangupdate', $first_date_array)->count('hangupid');
                $results['todays'][] = $first_day_count;
            }

            return response()->json(['status' => 200, 'data' => $results]);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }
    
    public function minuteLog(Request $request)
    {
        try {
            
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

}
