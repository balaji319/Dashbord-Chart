<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {

   public function basic_email() {
      $data = array('name'=>"BALAJI ");
      
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('harshal@xoyal.com', 'CALLQ')->subject
            ('Laravel Basic Testing Mail');
         $message->from('balajipastapure@gmail.com','BALAJI');
      });
      echo "Basic Email Sent. Check your inbox.";
   }

   public static function requestNewNumber($e_request) {
       
      Mail::send('mail', $e_request, function($message)  use ($e_request) {
         $message->to($e_request['email'], 'CALLQ')->subject
            ($e_request['name']. " is requesting a new Call-Q number");
         $message->from('balajipastapure@gmail.com','BALAJI');
         
      });
   }
}
