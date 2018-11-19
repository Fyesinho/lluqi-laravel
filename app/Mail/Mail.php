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

        $email->setTemplateId('d-ba3155d284d6448c9be9b2bb34122537');
        $sendgrid = new SendGrid("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");

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

        $email->setTemplateId('d-ba3155d284d6448c9be9b2bb34122537');
        $sendgrid = new SendGrid("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");

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

        $value = ($for == User::ROLE_TRAVELER) ? "d-0d38542b1610474fa96c57b616c71ff7" : "d-52559287326b4c398f92c00436068b0a";
        $emailSend->setTemplateId($value);
        $sendgrid = new SendGrid("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");

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