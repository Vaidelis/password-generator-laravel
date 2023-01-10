<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function generatePass(Request $request){
        $lowercase = 0;
        $uppercase = 0;
        $number = 0;
        $pass = "";
        $complex = $request->get('complexity');
        //------------------Password length
        if($request->get('price') != null){
            $length = $request->get('price');
        }
        else{
            $length = rand(8,12);
        }
        //--------------------------------------Letters and numbers(all of the passwords includes 1 uppercase, 1 lowercase and 1 number
        if($complex == 1) {
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            for ($i = 0; $i < $length; $i++) {
                $randomChar = $alphabet[rand(0, strlen($alphabet) - 1)];
                $pass = $pass . $randomChar;
            }
            if (preg_match('/[A-Z]/', $pass)) { //checks does password have uppercase chars
                $uppercase = 1;
            }
            else if ($uppercase == 0) {
                for ($i = 0; $i < 999; $i++) {
                    $randomChar = $pass[rand(0, strlen($pass) - 1)];
                    if (ctype_alpha($randomChar)) {
                        break;
                    }
                }
                $randomCharupper = strtoupper($randomChar);
                $pass = str_replace($randomChar, $randomCharupper, $pass);
            }
            if (preg_match('/[a-z]/', $pass)) {//checks does password have lowercase chars
                $lowercase = 1;
            }
            else if ($lowercase == 0) {
                for ($i = 0; $i < 999; $i++) {
                    $randomChar = $pass[rand(0, strlen($pass) - 1)];
                    if (ctype_alpha($randomChar)) {
                        break;
                    }
                }
                $randomCharlower = strtolower($randomChar);
                $pass = str_replace($randomChar, $randomCharlower, $pass);
            }
            for ($i = 0; $i < strlen($pass); $i++) {
                if (ctype_digit($pass[$i])) {//checks does password have numbers
                    $number = 1;
                    break;
                }
            }
            if ($number == 0) {
                $randomChar5 = $pass[rand(0, strlen($pass) - 1)];
                $s = (string)rand(0, 9);
                $pass = str_replace($randomChar5, $s, $pass);
            }
        }
        //---------------------Everything including special characters
        else if($complex == 2){
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!@#$%^&*()_{}[]?><";
            for ($i = 0; $i < $length; $i++) {
                $randomChar = $alphabet[rand(0, strlen($alphabet) - 1)];
                $pass = $pass . $randomChar;
            }
        }
        //--------------------Only numbers
        else if($complex == 3){
            $alphabet = "0123456789";
            for ($i = 0; $i < $length; $i++) {
                $randomChar = $alphabet[rand(0, strlen($alphabet) - 1)];
                $pass = $pass . $randomChar;
            }
        }
        //-----------------Only letters
        else if($complex == 4){
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
            for ($i = 0; $i < $length; $i++) {
                $randomChar = $alphabet[rand(0, strlen($alphabet) - 1)];
                $pass = $pass . $randomChar;
            }
        }
        return view('welcome')->with('pass', $pass);
    }
    public function savetofile($pass){

        Storage::put('file.txt', $pass);
        return redirect()->route('main')->with('pass', $pass);
    }
}
