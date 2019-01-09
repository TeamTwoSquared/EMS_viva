<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use SVP;
class MailController extends Controller
{
    public static function send_verify($user,$reciever)
    {
        if ($user == 1)//'1' means that mail has to be send for a SVP
        {
            $objVerify = new \stdClass();
            $objVerify->identity = 'svpverification';
            $objVerify->id = $reciever->service_provider_id;
            $objVerify->verifyLink = $reciever->activation_link;
            Mail::to($reciever->email)->send(new VerifyEmail($objVerify));
        }
        else
        {
            $objVerify = new \stdClass();
            $objVerify->identity = 'clverification';
            $objVerify->id = $reciever->customer_id;
            $objVerify->verifyLink = $reciever->activation_link;
            Mail::to($reciever->email)->send(new VerifyEmail($objVerify));
        }
    }
}
