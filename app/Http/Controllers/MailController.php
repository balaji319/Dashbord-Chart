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
         $message->to('balaji@ytel.co.in', 'CALLQ')->subject
            ('Laravel Basic Testing Mail');
         $message->from('balajipastapure@gmail.com','BALAJI');
      });
      echo "Basic Email Sent. Check your inbox.";
   }

}
