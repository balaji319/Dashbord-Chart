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
         $message->to(env('MAIL_TO_ADDRESS'), 'CALLQ')->subject
            ($e_request['name']. " is requesting a new Call-Q number");
         $message->from(env('MAIL_FROM_ADMIN'),env('MAIL_FROM_NAME'));

      });
   }
   
   
   public static function sentcallRecording($e_request) {
       
      Mail::send('recordingmail', $e_request, function($message)  use ($e_request) {
         $message->to($e_request['email'])->subject
            ("You have been sent an audio recording");
         $message->from(env('RECORDING_MAIL_FROM'),env('RECORDING_MAIL_NAME'));
         
      });
   }

   public function html_email() {
    $data = array('name'=>"Virat Gandhi");
    Mail::send('mail', $data, function($message) {
       $message->to('abc@gmail.com', 'Tutorials Point')->subject
          ('Laravel HTML Testing Mail');
       $message->from('xyz@gmail.com','Virat Gandhi');
    });
    echo "HTML Email Sent. Check your inbox.";
 }
 public function attachment_email() {
    $data = array('name'=>"Virat Gandhi");
    Mail::send('mail', $data, function($message) {
       $message->to('abc@gmail.com', 'Tutorials Point')->subject
          ('Laravel Testing Mail with Attachment');
       $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
       $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
       $message->from('xyz@gmail.com','Virat Gandhi');
    });
    echo "Email Sent with attachment. Check your inbox.";
 }

}
