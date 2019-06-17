<?php
namespace App;

class PasswordValidator
{
    public function check($password) {
        return strlen($password) >= 8 && preg_match_all('/[0-9]/', $password) > 0;
    }

    // public function check($password) {
    //     if (strlen($password) < 8) {
    //         return false;
    //     }
    //     if (preg_match_all('/[0-9]/', $password) < 1) {
    //         return false;
    //     }
    //     return true;
    // }
}

