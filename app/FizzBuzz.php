<?php
namespace App;

class FizzBuzz {

    public function execute($nums) {
        return join(', ', array_map(function($x) {
            return self::processNumber($x);
        }, $nums));
    }

    public function processNumber($num) {
        if ($num % 3 == 0 && $num % 5 == 0) {
            return "FizzBuzz";
        }
        if ($num % 3 == 0) {
            return "Fizz";
        }
        if ($num % 5 == 0) {
            return "Buzz";
        }
        return strval($num);
    }
}