<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Report;
use DB;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\MailController;

class ReportController extends Controller
{

    public function executiveReport(Request $request)
    {
        try {

            $response = Report::executiveReport($request);
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $response,
            ], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function detailsExecutiveReport(Request $request)
    {
        try {
            $response = Report::detailsExecutiveReport($request);
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $response,
            ], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function campaignList(Request $request)
    {
        try {
            $sql = "SELECT Campaign,CampaignID,Name FROM Campaigns where isactive = 1 and CompanyId1 = '" . session('user_info')->CompanyID . "' and Name <> 'AVAILABLE' Order by Name";
            $info = DB::select($sql);
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $info,
            ], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function networkReports(Request $request)
    {
        try {
            $report_month = $request->report_month;
            $report_year = $request->report_year;
            $report_month = $report_month <=9 ? '0' . $report_month : $report_month;
            $campaign_number = $request->campaign_number;
            if (empty($report_month) || empty($report_year) || empty($campaign_number)) {
                return response()->json(['status' => 400, 'message' => 'Please enter all details.'], 400);
            }
            $info = cal_days_in_month(CAL_GREGORIAN, $report_month, $report_year);
            $end_date = "$report_month/$report_year";
            if ($end_date == date("m/Y")) {
                $info = date("d");
            }
            $arr = [];
            for ($i = 1; $i <= $info; $i++) {
                $day = "$report_month/" . str_pad($i, 2, "0", STR_PAD_LEFT) . "/$report_year";
                $arr[$i]['day'] = $day . '-' . date('l', strtotime($day));

                $sql = "SELECT COUNT(*) AS total FROM HangUps WHERE convert(varchar, hangupdate, 101) = '" . $day . "' AND (CompanyID =  '" . session('user_info')->CompanyID . "') AND (CampaignID = '" . $campaign_number . "') ";
                $total = DB::select($sql);
                $arr[$i]['total'] = $total[0]->total;

                $sql = "SELECT COUNT(*) AS completed FROM HangUps WHERE convert(varchar, hangupdate, 101) = '" . $day . "' AND (CompanyID =  '" . session('user_info')->CompanyID . "') AND (CampaignID = '" . $campaign_number . "') and hangupcount = 2";
                $completed = DB::select($sql);
                $arr[$i]['completed'] = $completed[0]->completed;

            }

            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $arr,
            ], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function statistics(Request $request)
    {
        try {
            $current_time = date('m/d/Y');
            $seven_day = date('m/d/Y', strtotime('-7 days'));
            $fourteen_day = date('m/d/Y', strtotime('-14 days'));
            $twenty_one_day = date('m/d/Y', strtotime('-21 days'));

            $sql = "SELECT COUNT(HangUps.hangupid) AS CallCount, day(HangUps.hangupdate) CallDate,CONVERT(CHAR(10), HangUps.hangupdate, 101) as hangupdate
                FROM HangUps INNER JOIN Campaigns ON HangUps.CampaignID = Campaigns.CampaignID WHERE HangUps.CompanyID = '" . session('user_info')->CompanyID . "'
                AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) >= '" . $seven_day . "' AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) <= '" . $current_time . "'
                GROUP BY day(HangUps.hangupdate),CONVERT(CHAR(10), HangUps.hangupdate, 101)
                Order By day(HangUps.hangupdate)";
            $last_week = DB::select($sql);
            foreach ($last_week as $k => $v) {
                $week_array[date('l', strtotime($v->hangupdate))] = $v->CallCount;
                $days_array[] = date('l', strtotime($v->hangupdate));
            }

            $sql = "SELECT COUNT(HangUps.hangupid) AS CallCount, day(HangUps.hangupdate) CallDate,CONVERT(CHAR(10), HangUps.hangupdate, 101) as hangupdate
                FROM HangUps INNER JOIN Campaigns ON HangUps.CampaignID = Campaigns.CampaignID WHERE HangUps.CompanyID = '" . session('user_info')->CompanyID . "'
                AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) > '" . $fourteen_day . "' AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) <= '" . $seven_day . "'
                GROUP BY day(HangUps.hangupdate),CONVERT(CHAR(10), HangUps.hangupdate, 101)
                Order By day(HangUps.hangupdate)";
            $last_fourteen = DB::select($sql);
            foreach ($last_fourteen as $k => $v) {
                $fourteen_array[date('l', strtotime($v->hangupdate))] = $v->CallCount;
            }

            $sql = "SELECT COUNT(HangUps.hangupid) AS CallCount, day(HangUps.hangupdate) CallDate,CONVERT(CHAR(10), HangUps.hangupdate, 101) as hangupdate
                FROM HangUps INNER JOIN Campaigns ON HangUps.CampaignID = Campaigns.CampaignID WHERE HangUps.CompanyID = '" . session('user_info')->CompanyID . "'
                AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) > '" . $twenty_one_day . "' AND CAST(CONVERT(CHAR(10), HangUps.hangupdate, 101) AS DATETIME) <= '" . $fourteen_day . "'
                GROUP BY day(HangUps.hangupdate),CONVERT(CHAR(10), HangUps.hangupdate, 101)
                Order By day(HangUps.hangupdate)";
            $twenty_one = DB::select($sql);
            foreach ($twenty_one as $k => $v) {
                $twenty_one_array[date('l', strtotime($v->hangupdate))] = $v->CallCount;
            }

            $date = array_unique($days_array);
            foreach ($date  as $k => $v) {
                $arr['week_array'][] = $week_array[$v];
                $arr['fourteen_array'][] = $fourteen_array[$v];
                $arr['twenty_one_array'][] = $twenty_one_array[$v];
                $arr['days_array'][] = $v;
            }
            return response()->json(['status' => 200, 'message' => 'Success', 'data' => $arr], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function topCities(Request $request)
    {
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
                IVRTranscriptions.CompanyID = '" . session('user_info')->CompanyID . "'
                AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) >= '" . $startdate . "'
                AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) <= '" . $enddate . " 11:59 PM'
                GROUP BY City + ', ' + State
                ORDER BY COUNT(*) DESC";
            $top_city = DB::select($sql);
            foreach ($top_city as $k => $v) {
                $top_cities['CallCount'][] = $v->CallCount;
                $top_cities['City'][] = $v->City;
            }

            return response()->json(['status' => 200, 'message' => 'Success', 'data' => $top_cities], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function topCountries(Request $request)
    {
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
            $sql = "SELECT TOP 25 COUNT(*) AS CallCount, Country AS City FROM IVRTranscriptions
                    WHERE (IVRTranscriptions.City IS NOT NULL AND IVRTranscriptions.City <> '') AND
                    IVRTranscriptions.CompanyID = '" . session('user_info')->CompanyID . "' AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) >= '" . $startdate . "' AND CAST(CONVERT(CHAR(10), IVRTranscriptions.dateentered, 102) AS DATETIME) <= '" . $enddate . " 11:59 PM'
                    GROUP BY Country ORDER BY COUNT(*) DESC";
            $top_country = DB::select($sql);
            foreach ($top_country as $k => $v) {
                $top_countries['CallCount'][] = $v->CallCount;
                $top_countries['City'][] = $v->City;
            }
            return response()->json(['status' => 200, 'message' => 'Success', 'data' => $top_countries], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function websiteSummery(Request $request)
    {
        try {
            $month = $request->month;
            $year = $request->year;
            if (empty($month)) {
                $month = date('m');
            }
            if (empty($year)) {
                $year = date('Y');
            }
            $date = "$month/1/$year";
            $sql = "SELECT Count(*) as Completed FROM IVRTranscriptions WHERE CompanyID = '" . session('user_info')->CompanyID . "' AND DateEntered >= '" . $date . "' AND GroupNumber = 'Web'";
            $summery = DB::select($sql);
            return response()->json(['status' => 200, 'message' => 'Success', 'data' => $summery], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function countriesStationBreakdown(Request $request)
    {
        try {
            $month = $request->month;
            $year = $request->year;
            if (empty($month)) {
                $month = date('m');
            }
            if (empty($year)) {
                $year = date('Y');
            }
            $date = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $now_date = "$month/$year";
            if ($now_date == date("m/Y")) {
                $date = date('d');
            }
            $start_date = "$month/01/$year";
            $end_date = "$month/$date/$year";

            $sql = "SELECT Geography FROM Campaigns where CompanyID1 = '" . session('user_info')->CompanyID . "' and geography <> 'unknown' group by Geography Order By Geography";
            $geography = DB::select($sql);
            $str = "";
            foreach ($geography as $k => $v) {
                $str .= "'" . $v->Geography . "',";
            }
            $geogra = rtrim($str, ',');

            $sql = "SELECT count(*) as Calls, Name
                    FROM HangUps INNER JOIN
                    Campaigns ON HangUps.CampaignID = Campaigns.CampaignID
                    where CompanyID = '" . session('user_info')->CompanyID . "'  AND Hangupdate >= '" . $start_date . "'
                    AND Hangupdate < '" . $end_date . "'
                    and Campaigns.Geography IN (" . $geogra . ")
                    Group by Name";
            $summery = DB::select($sql);

            return response()->json(['status' => 200, 'message' => 'Success', 'data' => $summery], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function callRecording(Request $request)
    {
        try {
            $startdate = $request->startdate;
            $enddate = $request->enddate;
            if (empty($startdate)) {
                $startdate = date('m/d/Y');
            }
            if (empty($enddate)) {
                $enddate = date('m/d/Y');
            }
            $sql = DB::table('IVRCounter')
                ->join('Campaigns', 'IVRCounter.Campaign', '=', 'Campaigns.Campaign')
                ->select(DB::raw("IVRCounter.Tracking_ID, LEFT(IVRCounter.CallerID, 3) + '-' + SUBSTRING(IVRCounter.CallerID, 4, 3) + '-' + RIGHT(IVRCounter.CallerID, 4) AS ANI, CONVERT(varchar(10),
                        IVRCounter.DateEntered, 101) AS DatePart, CONVERT(VARCHAR, IVRCounter.DateEntered, 108) AS TimePart, CONVERT(varchar(6), IVRCounter.CallDuration / 3600)
                        + ':' + RIGHT('0' + CONVERT(varchar(2), IVRCounter.CallDuration % 3600 / 60), 2) + ':' + RIGHT('0' + CONVERT(varchar(2), IVRCounter.CallDuration % 60), 2) AS Duration,
                        Campaigns.Campaign as Number, Campaigns.Name as Station"))
                ->where('DateEntered', '>=', $startdate)
                ->where('DateEntered', '<', $enddate . " 11:59:59 PM")
                ->where('CompanyID', session('user_info')->CompanyID)
                ->orderBy('DateEntered')
                ->get();
            return response()->json(['status' => 200, 'message' => 'Success', 'data' => $sql], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function callRecordingFile(Request $request)
    {
        try {
            $tracking_id = $request->TRacking_ID;
            if (empty($tracking_id)) {
                return response()->json(['status' => 400, 'message' => "Tracking id is required."], 400);
            }
            $startdate = $request->startdate;
            $sql = DB::table('ivrcounter')
                ->select(DB::raw("Tracking_ID,WavLocation,TranscribedDate"))
                ->where('dateentered', '>=', '7/15/2009')
                ->where('Tracking_ID', $tracking_id)->get();
            return response()->json(['status' => 200, 'message' => 'Success', 'data' => $sql], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function callRecordingDetails(Request $request)
    {
        try {
            $tracking_id = $request->TRacking_ID;
            $email = $request->email;
            if (empty($tracking_id)) {
                return response()->json(['status' => 400, 'message' => "Tracking id is required."], 400);
            }
            $startdate = $request->startdate;
            $sql = DB::table('ivrcounter')
                ->select(DB::raw("Tracking_ID,WavLocation,CallerID,TranscribedDate"))
                ->where('dateentered', '>=', '7/15/2009')
                ->where('Tracking_ID', $tracking_id)->first();
            $email_id = explode(",",$email);
            $invalide_email = '';
            $invalide_email = '';
            foreach ($email_id as $k => $v ) {
                $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
                preg_match($pattern, $v) === 1 ? $v_email = $v.", " : $invalide_email .= $v.", ";
                $data = ["email"=>$v, "download_link"=>$sql->WavLocation,"caller_id"=>$sql->CallerID,"date"=>$sql->TranscribedDate];
                $info = MailController::sentcallRecording($data);
            }
            
            if($invalide_email != '') {
                $success = '';
                if($v_email != '') { $success = " Email sent to ".rtrim($v_email,', ').".";  }
                return response()->json(['status' => 400, 'message' => rtrim($invalide_email,', ')." is not a valid email address.".$success ] , 400);
            } else {
                return response()->json(['status' => 200, 'message' => 'Success'], 200);
            }
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }


    public function activeNumbers(Request $request) {
        try {
            $array_min = [] ;
            $startdate = $request->startdate;
            $enddate = $request->enddate;
            if (empty($startdate)) {
                $startdate = date('m/d/Y');
            }
            if (empty($enddate)) {
                $enddate = date('m/d/Y');
            }
            $now = time();
            $sql = DB::table('Campaigns')
                    ->where('isactive','=','1')
                    ->where('CompanyID1',session('user_info')->CompanyID)->orderBy('name')->get();
            foreach($sql as $k => $v) {
                $sql = DB::table('hangups')
                    ->where('hangupdate','>=',$startdate)
                    ->where('hangupdate','<', $enddate." 11:59:59 PM")
                    ->where('CompanyID',session('user_info')->CompanyID)
                    ->where('campaign',$v->Campaign)->count();
                $station_id = str_replace("-","",$v->Campaign);
                $v->station_id = "A".$station_id;
                $v->count = $sql;
                $new_date = strtotime($v->LastUpdated);
                $datediff = $now - $new_date;
                $v->last_updated = round($datediff / (60 * 60 * 24));
                $array_min[] = round($datediff / (60 * 60 * 24));;
                $arr[$k] = $v;
            }
            return response()->json([ 'status' => 200, 'message' => 'Success', 'data' => $arr ,'min_value'=> min($array_min) ], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function requestNumber(Request $request) {
        try {

            $name = $request->name;
            $email = $request->email;
            $station_name = $request->station_name;
            $urgent = $request->urgent;
            $country = $request->country;
            $number_type = $request->number_type;
            $comments = $request->comments;

            $data = ["name"=>$name, "email"=>$email,"station_name"=>$station_name,
                "urgent"=>$urgent,"country"=>$country,"number_type"=>$number_type,
                "comments"=>$comments,"company"=>session('user_info')->CompanyID];
            $info = MailController::requestNewNumber($data);

            return response()->json([ 'status' => 200, 'message' => 'Success'], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function downoad(Request $request) {
        try {
            $filename=$request->filename;
            $filesInFolder = \File::files('Files/localuser');
            header("Content-type: text/csv");
            $file = public_path('/Files/localuser/'.$filename);
            readfile( $file);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }

    public function googleMap(Request $request) {
        try {
            $data_type= $request->data_type;
            $app_hour=$request->app_hour;
            // Creates an array of strings to hold the lines of the KML file.
            $kml = array('<?xml version="1.0" encoding="UTF-8"?>');
            $kml[] = '<kml xmlns="http://earth.google.com/kml/2.1">';
            $kml[] = ' <Document>';
            $kml[] = ' <Folder>';
            if($data_type == 1) {
                $date = date("m/d/Y g:i:s A",strtotime("-$app_hour hour"));
                $sql = "SELECT DISTINCT FONE1.Col003 AS City1, FONE1.Col004 AS State1, FONE1.Col005 AS Lat, FONE1.Col006 AS Long,hangups.CallerID
                        FROM hangups INNER JOIN FONE1 ON LEFT(REPLACE(hangups.callerID,'-',''), 6) = CAST(FONE1.Col001 AS varchar) + '' + CAST(FONE1.Col002 AS varchar)
                        WHERE (hangups.hangupdate >= '$date') AND (hangups.CompanyID = '".session('user_info')->CompanyID."')";
                $summery = DB::select($sql);
                // Iterates through the rows, printing a node for each row.
                foreach ($summery as $k => $v ) {
                    $kml[] = ' <altitudeMode>relativeToGround</altitudeMode>';
                    $kml[] = ' <coordinates>-' .$v->Long  . ','  .$v->Lat . ',50</coordinates>';
                    $kml[] = ' <Placemark>';
                    $kml[] = ' <name>' . htmlentities( $v->CallerID) . '</name>';
                    $kml[] = ' <description>'.$v->City1.','.$v->State1.'</description>';
                    $kml[] = ' <LookAt><longitude>99</longitude><latitude>-40</latitude><range>27</range><tilt>73.51179687707364</tilt><heading>-171.0039963981923</heading></LookAt> ';
                    $kml[] = ' <Style><IconStyle><scale>0.6</scale><Icon><href>http://66.193.54.196/Dot.png</href></Icon></IconStyle></Style>';
                    $kml[] = ' <Point>';
                    $kml[] = ' <coordinates>-' .$v->Long  . ','  .$v->Lat . ',0</coordinates>';
                    $kml[] = ' </Point>';
                    $kml[] = ' </Placemark>';
                }
            } else {
                $date = date('m/d/Y', strtotime("-$app_hour days"));
                $sql = "SELECT distinct IVRTranscriptions.FirstName + ' ' + IVRTranscriptions.LastName AS FullName, IVRTranscriptions.Address, IVRTranscriptions.City,
                      IVRTranscriptions.State, IVRTranscriptions.Zip, IVRTranscriptions.Country, LatLong.Lat, LatLong.Long, IVRTranscriptions.DateEntered,
                      IVRTranscriptions.CompanyID FROM IVRTranscriptions INNER JOIN LatLong ON IVRTranscriptions.IVR_ID = LatLong.IVR_ID
                      WHERE (IVRTranscriptions.City <> '') AND (IVRTranscriptions.City IS NOT NULL) AND (IVRTranscriptions.Address <> '') AND
                      (IVRTranscriptions.Address IS NOT NULL) AND (Dateentered >= '$date') AND (CompanyID = '".session('user_info')->CompanyID."')";
                $summery = DB::select($sql);
                if (!empty($playerlist)) {
                    foreach ($summery as $k => $v ) {
                        $kml[] = ' <altitudeMode>relativeToGround</altitudeMode>';
                        $kml[] = ' <coordinates>-' .$v->Long  . ','  .$v->Lat . ',50</coordinates>';
                        $kml[] = ' <Placemark>';
                        $kml[] = ' <name>' . htmlentities( $v->FullName) . '</name>';
                        $kml[] = ' <description>'.$v->FullName.'\n'.$v->address.'\n'.$v->city.'\n'.$v->State.'\n'.$v->Country.'\n</description>';
                        $kml[] = ' <LookAt><longitude>99</longitude><latitude>-40</latitude><range>27</range><tilt>73.51179687707364</tilt><heading>-171.0039963981923</heading></LookAt> ';
                        $kml[] = ' <Style><IconStyle><scale>0.6</scale><Icon><href>http://66.193.54.196/Dot.png</href></Icon></IconStyle></Style>';
                        $kml[] = ' <Point>';
                        $kml[] = ' <coordinates>-' .$v->Long  . ','  .$v->Lat . ',0</coordinates>';
                        $kml[] = ' </Point>';
                        $kml[] = ' </Placemark>';
                    }
                 }else{
                    $kml[] = ' <altitudeMode>relativeToGround</altitudeMode>';
                    $kml[] = ' <coordinates>-20,50</coordinates>';
                    $kml[] = ' <Placemark>';
                    $kml[] = ' <name>No </name>';
                    $kml[] = ' <description>pune</description>';
                    $kml[] = ' <LookAt><longitude>99</longitude><latitude>-40</latitude><range>27</range><tilt>73.51179687707364</tilt><heading>-171.0039963981923</heading></LookAt> ';
                    $kml[] = ' <Style><IconStyle><scale>0.6</scale><Icon><href>http://66.193.54.196/Dot.png</href></Icon></IconStyle></Style>';
                    $kml[] = ' <Point>';
                    $kml[] = ' <coordinates>-20,0</coordinates>';
                    $kml[] = ' </Point>';
                    $kml[] = ' </Placemark>';
                 }
                // Iterates through the rows, printing a node for each row.

            }
            // End XML file
            $kml[] = '</Folder>';
            $kml[] = '</Document>';
            $kml[] = '</kml>';
            $kmlOutput = join("\n", $kml);
            $filename = md5(uniqid(rand(), true));
            header('Content-type: application/kml');
            header('Content-Disposition: inline; filename='."$filename.kml".';');
            echo $kmlOutput;
            return redirect('map-calls');
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }


    public function genderReport(Request $request)
    {
        try {
            $gender_report =[];
            $startdate = $request->startdate;
            $enddate = $request->enddate;
            $campaign_id = $request->campaign_number;
            if (empty($startdate)) {
                $startdate = date('m/01/Y');
            }
            if (empty($enddate)) {
                $enddate = date('m/d/Y');
            }
            $sql = "SELECT COUNT(*) AS Calls, IVRTranscriptions.Gender FROM IVRTranscriptions INNER JOIN IVRCounter ON IVRTranscriptions.GroupNumber = IVRCounter.GroupNumber
                    WHERE (IVRTranscriptions.DateEntered > '12/01/2018') AND (IVRTranscriptions.DateEntered < '$enddate') AND (IVRCounter.CampaignID = '$campaign_id')
                    AND (IVRCounter.companyID ='".session('user_info')->CompanyID."') GROUP BY IVRTranscriptions.Gender";
            $gender= DB::select($sql);
            foreach ($gender as $k => $v) {
                $gender_report['Calls'][] = $v->Calls;
                if($v->Gender == 1 ){ $gener_name = "MALE";} else if($v->Gender == 2 ){ $gener_name = "FEMALE";} else if($v->Gender == 0 ){ $gener_name = "UNKNOWN";}else  { $gener_name = "BOTH";}
                $gender_report['Gender'][] = $gener_name;
            }
            return response()->json(['status' => 200, 'message' => 'Success', 'data' => $gender_report], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 400, 'message' => $ex->getMessage()], 400);
        }
    }


}

