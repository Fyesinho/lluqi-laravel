<?php

namespace App\Mail;

use App\User;
use Illuminate\Support\Facades\Log;
use SendGrid;

class Mail{

    static public function newUser($name, $emailUser){
        $email = new SendGrid\Mail\Mail();
        $email->setFrom(Config('app.sendgrid_from'), Config('app.sendgrid_from_user'));
        $email->addTo(
            $emailUser,
            $name,
            [
                "USERNAME" => $name,
            ],
            0
        );

        $email->setTemplateId(Config('app.sendgrid_newuser'));
        $sendgrid = new SendGrid(Config('app.sendgrid_key'));

        Log::info("[MAIL] new user ". $name . "(".$emailUser.")");
        try {
            $response = $sendgrid->send($email);
            Log::info($response->statusCode());
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            Log::info('Caught exception: '.  $e->getMessage());
        }
    }

    static public function changePassword($name, $emailUser){
        $email = new SendGrid\Mail\Mail();
        $email->setFrom(Config('app.sendgrid_from'), Config('app.sendgrid_from_user'));
        $email->addTo(
            $emailUser,
            $name,
            [
                "USERNAME" => $name,
            ],
            0
        );

        $email->setTemplateId(Config('app.sendgrid_newuser'));
        $sendgrid = new SendGrid(Config('app.sendgrid_key'));

        Log::info("[MAIL] change password ". $name . "(".$emailUser.")");
        try {
            $response = $sendgrid->send($email);
            Log::info($response->statusCode());
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            Log::info('Caught exception: '.  $e->getMessage());
        }
    }

    static public function newMessage($nameTo, $emailTo, $username, $hostalname, $for){
        $emailSend = new SendGrid\Mail\Mail();
        $emailSend->setFrom(Config('app.sendgrid_from'), Config('app.sendgrid_from_user'));
        $emailSend->addTo(
            $emailTo,
            $nameTo,
            [
                "USERNAME"      => $username,
                "HOSTALNAME"    => $hostalname
             ],
            0
        );

        $value = ($for == User::ROLE_TRAVELER) ? Config('app.sendgrid_newmessage_fortraveler') : Config('app.sendgrid_newmessage_forhostal');
        $emailSend->setTemplateId($value);
        $sendgrid = new SendGrid(Config('app.sendgrid_key'));

        $nameFrom = ($for == User::ROLE_TRAVELER) ? $hostalname : $username;
        Log::info("[MAIL] new message for ". $nameTo . " from " .$nameFrom);
        try {
            $response = $sendgrid->send($emailSend);
            Log::info("[MAIL] Response status code: " .$response->statusCode());
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            Log::info('Caught exception: '.  $e->getMessage());
        }
    }
}