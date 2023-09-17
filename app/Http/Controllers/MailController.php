<?php

namespace App\Http\Controllers;

use Mail;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function sendmail() {
    $data = array('name'=>"Danil");
        
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('danilaysin@gmail.com')
                ->subject('Mail message to manager')
                ->from('mailtest@gmail.com', 'Test Server')
                ->bcc('danilaysin@mail.ru');
         });

         echo "Messages sent";
    }
}
