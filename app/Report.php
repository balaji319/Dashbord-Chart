<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Illuminate\Http\Request;

class Report extends Model {

    public static function executiveReport(Request $request) {
        try {
            $startdate = $request->startdate;
            $enddate = $request->enddate;
            if (empty($startdate)) {
                $startdate = date('m/d/Y');
            }
            if (empty($enddate)) {
                $enddate = date('m/d/Y');
            }
            $current_time = date('m/d/Y');
            $sql = "SELECT Count(*) as Calls, hangupcount  FROM hangups WHERE CONVERT(CHAR(10),Hangupdate,101) = '" . $current_time . "' and CompanyID = '" . session('user_info')->CompanyID . "' GROUP BY hangupcount";
            $info = DB::select($sql);
            $totao_calls = $info[0]->Calls + $info[1]->Calls;
            $today_array['day'] = date('D');
            $today_array['date'] = 'Today';
            $today_array['total_calls'] = $info[0]->Calls + $info[1]->Calls;
            $today_array['completed'] = $info[0]->Calls;
            $today_array['incomplete'] = $info[1]->Calls;
            $today_array['per_comp'] = round(($info[1]->Calls / $totao_calls ) * 100, 2) . "%";
            $today_array['per_incomp'] = round(($info[0]->Calls / $totao_calls ) * 100, 2) . "%";
            $today_array['file_1'] = 'In Process';
            $today_array['file_2'] = 'In Process';
            $today_array['file_3'] = 'In Process';
            $today_array['Web'] = 'In Process';

            $total = "SELECT sum(TotalCalls) as totalcalls,sum(CompletedCalls) as CompletedCalls,Sum(Hangups) as Hangups,Sum(File1) as file1,sum(File2) as File2,Sum(File3) as File3,
                Sum(Web) as web,case when sum(TotalCalls) <> 0 then cast(cast(round((cast(sum(CompletedCalls) as float) / cast(sum(TotalCalls) As float)) * cast(100 as float),2) as decimal) as varchar) + '%' 
                else '0%' end as PercentComplete,case when sum(TotalCalls) <> 0 then cast(cast(round((cast(Sum(Hangups) as float) / cast(sum(TotalCalls) As float)) * cast(100 as float),2) as decimal) as varchar) + '%' else '0%' end as PercentIncomplete
                FROM ExecutiveReport
                WHERE    DayDate >= '" . $startdate . "' AND DayDate <= '" . $enddate . "' and (CompanyID =  '" . session('user_info')->CompanyID . "') and daydate <> '" . $current_time . "'";
            $total_report = DB::select($total);

            $date_report = "SELECT left(datename(dw, CONVERT(CHAR(10),DayDate,101)),3) as dayname,CONVERT(CHAR(10),DayDate,101) as DayDate,TotalCalls,CompletedCalls,Hangups,File1,File2,File3,Web,
                case when totalcalls <> 0 then cast(cast(round((cast(CompletedCalls as float) / cast(TotalCalls As float)) * cast(100 as float),2) as decimal) as varchar) + '%' else '0%' end as PercentComplete,
                case when totalcalls <> 0 then cast(cast(round((cast(Hangups as float) / cast(TotalCalls As float)) * cast(100 as float),2) as decimal) as varchar) + '%' else '0%' end as PercentIncomplete
                FROM ExecutiveReport
                WHERE    DayDate >= '" . $startdate . "' AND 
                DayDate <= '" . $enddate . "' and 
                (CompanyID = '" . session('user_info')->CompanyID . "') and daydate <> '" . $current_time . "'
                ORDER BY  DayDate asc";
            $days_report = DB::select($date_report);

            $arr = ["today_array" => $today_array, "total_report" => $total_report, "days_report" => $days_report];
            return $arr;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
