<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function generatePass(){
        $lowercase = 0;
        $uppercase = 0;
        $number = 0;
        $lenght = rand(8,12);
        $pass = "";
//$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
//$alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
//$alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
        for ($i = 0; $i < $lenght; $i++) {
            $randomChar = $alphabet[rand(0, strlen($alphabet)-1)];
            $pass = $pass . $randomChar;
        }
        if(preg_match('/[A-Z]/', $pass)) {
            $uppercase = 1;
        }
        else if($uppercase == 0){
            for($i = 0; $i < 999; $i++){
                $randomChar = $pass[rand(0, strlen($pass)-1)];
                if(ctype_alpha($randomChar)){
                    break;
                }
            }
            $randomCharupper = strtoupper($randomChar);
            $pass = str_replace($randomChar, $randomCharupper, $pass);
        }
        if(preg_match('/[a-z]/', $pass)) {
            $lowercase = 1;
        }
        else if($lowercase == 0){
            for($i = 0; $i < 999; $i++){
                $randomChar = $pass[rand(0, strlen($pass)-1)];
                if(ctype_alpha($randomChar)){
                    break;
                }
            }
            $randomCharlower = strtolower($randomChar);
            $pass = str_replace($randomChar, $randomCharlower, $pass);
        }
        for ($i = 0; $i < strlen($pass); $i++) {
            if ( ctype_digit($pass[$i]) ) {
                $number = 1;
                break;
            }
        }
        if($number == 0){
            $randomChar5 = $alphabet[rand(0, strlen($alphabet)-1)];
            $s = rand(0,9);
            $pass = str_replace($randomChar5, $s, $pass);
        }
        return view('welcome')->with('pass', $pass);
    }
}
