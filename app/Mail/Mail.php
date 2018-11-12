<?php

namespace App\Mail;

use App\User;
use Illuminate\Support\Facades\Log;
use SendGrid;

class Mail{

    static public function newUser($name, $emailUser){
        $email = new SendGrid\Mail\Mail();
        $email->setFrom("info@lluqi.com", "El equipo de lluqi.com");
        $email->addTo(
            $emailUser,
            $name,
            [
                "USERNAME" => $name,
            ],
            0
        );

        $email->setTemplateId(env('SENDGRID_NEWUSER'));
        $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

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
        $email->setFrom("info@lluqi.com", "El equipo de lluqi.com");
        $email->addTo(
            $emailUser,
            $name,
            [
                "USERNAME" => $name,
            ],
            0
        );

        $email->setTemplateId(env('SENDGRID_NEWUSER'));
        $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

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
        $emailSend->setFrom("info@lluqi.com", "El equipo de lluqi.com");
        $emailSend->addTo(
            $emailTo,
            $nameTo,
            [
                "USERNAME"      => $username,
                "HOSTALNAME"    => $hostalname
             ],
            0
        );

        $value = ($for == User::ROLE_TRAVELER) ? "SENDGRID_NEWMESSAGE_FORTRAVELER" : "SENDGRID_NEWMESSAGE_FORHOSTAL";
        $emailSend->setTemplateId(env($value));
        $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

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