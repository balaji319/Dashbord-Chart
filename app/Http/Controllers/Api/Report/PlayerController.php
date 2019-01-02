<?php

namespace App\Http\Controllers\Api\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use DB;

class PlayerController extends Controller
{
    /**
     * Get top player
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function topPlayer(Request $request)
    {
        try {

            $results = [];
            $company_id = session('user_info')->CompanyID;
            $from_date = $request->get('from_date', NULL);
            $to_date = $request->get('to_date', NULL);
            
            if($from_date == NULL){
                $from_date = Carbon::today();
            }else{
                $from_date = Carbon::parse($from_date);
            }
            
            if($to_date == NULL){
                $to_date = Carbon::today()->addDays(25);
            }else{
                $to_date = Carbon::parse($to_date);
            }
            $from_date = $from_date->format('m/d/Y');
            $to_date = $to_date->format('m/d/Y');
            
            $query = "SELECT TOP 25 COUNT(*) AS CallCount, Prayerslist.Prayer FROM IVRTranscriptions";
            $query .= " INNER JOIN Prayerslist ON IVRTranscriptions.PrayerID = Prayerslist.PrayerID";
            $query .= " WHERE (IVRTranscriptions.GroupNumber <> 'web')";
            $query .= " AND (IVRTranscriptions.City IS NOT NULL";
            $query .= " AND IVRTranscriptions.City <> '')";
            $query .= " AND IVRTranscriptions.CompanyID = '$company_id'";
            $query .= " AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) >= '$from_date'";
            $query .= " AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) <= '$to_date'";
            $query .= " and (Prayerslist.prayer <> 'none') GROUP BY Prayerslist.Prayer";
            $query .= " ORDER BY COUNT(*) DESC";
            $top_player = DB::select($query);
            $results['top_player'] = $top_player;
            
            $query = "SELECT TOP 25 COUNT(*) AS CallCount, Prayerslist.PrayerCategory FROM IVRTranscriptions";
            $query .= " INNER JOIN Prayerslist ON IVRTranscriptions.PrayerID = Prayerslist.PrayerID";
            $query .= " WHERE (IVRTranscriptions.GroupNumber <> 'web') ";
            $query .= " AND (IVRTranscriptions.City IS NOT NULL AND IVRTranscriptions.City <> '')";
            $query .= "  AND IVRTranscriptions.CompanyID = '$company_id'";
            $query .= " AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) >= '$from_date'";
            $query .= " AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) <= '$to_date'";
            $query .= " and (Prayerslist.prayer <> 'none')";
            $query .= " GROUP BY Prayerslist.PrayerCategory";
            $query .= " ORDER BY COUNT(*) DESC";
            $prayer_categories = DB::select($query);
            
            $results['prayer_categories'] = $prayer_categories;
            
            return response()->json(['status' => 200, 'data' => $results]);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }
}
