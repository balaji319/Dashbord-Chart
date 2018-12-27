<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Home extends Model
{
    public static function advertSpikesPastHour() {
        try {
            $minutes_in = date('i');
            $minutes_in_minus = date('i', strtotime('-1 hour'));
            $last_hr_time = date('Y-m-d H:i:s', strtotime('-1 hour'));
            $current_time = date('Y-m-d H:i:s');
            $min_arr = [];
            $count_arr = [];
            for($i=$minutes_in; $i <= 60; $i=$i+2 ){
               $sql = "SELECT count(*) as Calls FROM hangups where DATEPART(minute, hangupdate) = '".$i."' and hangupdate >= '".$last_hr_time."' and CompanyID = '". session('user_info')->CompanyID ."'";
               $info = DB::select($sql);

               $min_arr[] = $i;
               $count_arr[] = $info[0]->Calls;
            }
            for($i=0; $i < $minutes_in_minus; $i=$i+2 ){
               $sql = "SELECT count(*) as Calls FROM hangups where DATEPART(minute, hangupdate) = '".$i."' and hangupdate >= '".$last_hr_time."' and CompanyID = '". session('user_info')->CompanyID ."'";
               $info = DB::select($sql);
               $min_arr[] = $i;
               $count_arr[] = $info[0]->Calls;
            }
            $adv_spikes = ['min'=>$min_arr,'count_arr'=>$count_arr];
            return $adv_spikes;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public static function hourlyCalls() {
        try {
            $current_time = date('Y-m-d H:i:s');
            $hrs_calls = [];
            $count_arr = [];
            for($i=0; $i <= 23; $i++ ){
               $sql = "SELECT count(*) as Calls FROM hangups where DATEPART(hour, hangupdate) = '".$i."' and hangupdate >= '".date('Y-m-d')."' and CompanyID = '". session('user_info')->CompanyID ."' and hangupdate < '".$current_time."'";
               $info = DB::select($sql);
               $hrs_calls[] = $i;
               $count_arr[] = $info[0]->Calls;
            }
            $arr = ['hrs_calls'=>$hrs_calls,'count_arr'=>$count_arr];
            return $arr;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function mostRecentCalls() {
        try {
            $current_time = date('Y-m-d H:i:s');
            $hrs_calls = [];
            $sql = "SELECT TOP 10 Campaigns.Name, HangUps.HangUpCount, HangUps.CallerID, HangUps.CallDuration,Campaigns.Campaign FROM hangups HangUps INNER JOIN campaigns Campaigns ON HangUps.CampaignID = Campaigns.CampaignID"
                    . " where CompanyID = '". session('user_info')->CompanyID ."' and hangupdate >= '".date('Y-m-d')."' and hangupdate < '".$current_time."' order by hangupdate desc";
            $info = DB::select($sql);

            return $info;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public static function topActiveNumbers() {
        try {
            $current_time = date('Y-m-d H:i:s');
            $hrs_calls = [];
            $sql = "SELECT TOP 10 COUNT(*) AS Calls, Campaigns.Name,Campaigns.Campaign  FROM hangups HangUps INNER JOIN campaigns Campaigns ON HangUps.CampaignID = Campaigns.CampaignID"
                    . " where CompanyID = '". session('user_info')->CompanyID ."' and hangupdate <= '".$current_time."' and hangupdate >= '".date('Y-m-d'). " 12:00 AM' GROUP BY Campaigns.Name,Campaigns.Campaign ORDER BY COUNT(*) DESC";
            $info = DB::select($sql);
            $arr = [];
            foreach ($info as $key => $value) {
                $arr[$key]['Calls'] = $value->Calls;
                $arr[$key]['Name'] = $value->Name;
                $query = "SELECT top 1 Hangupdate FROM hangups where CompanyID = '". session('user_info')->CompanyID ."' and campaign IN ('".$value->Campaign."') and hangupdate < '".$current_time."' ORDER BY hangupdate desc";
                $info = DB::select($query);
                $arr[$key]['LastCall'] = date("m/d h:i:s A", strtotime($info[0]->Hangupdate));
            }
            return $arr;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
