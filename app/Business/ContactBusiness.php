<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 3/1/2017
 * Time: 7:46 PM
 */

namespace App\Business;

use Illuminate\Support\Facades\Mail;
use App\YourNewsBusiness\ResultObject;

class ContactBusiness
{
    public function postContact($array)
    {
        $result = new ResultObject();
        try {
            $mail = Mail::send('email.contact', $array, function ($msg) {
                $msg->from('thetung.pdca@gmail.com', 'Yournews system');
                $msg->to('romelikeyou@gmail.com', 'admin')
                    ->subject('New message to Manager!');
            });
            $result->messageCode = 1;
            $result->message
                = "<script>alert('Thank for your feedback, we will reply soon!'); window.location='"
                .url('index')."';</script>";

        } catch (\Exception $ex) {
            $result->messageCode = 0;
            $result->message
                = "<script>alert('Sorry, but you could not send this Email!'); window.location='"
                .url('contact')."';</script>";
        }
        return $result;
    }
}