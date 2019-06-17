<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\FizzBuzz;

class FizzBuzzTest extends TestCase
{
    // https://learnitmyway.com/tdd-example/


    public function testShouldProcessNumber1()
    {
        // Arrange
        $fizzBuzz = new FizzBuzz;

        // Act
        $output = $fizzBuzz->processNumber(1);

        // Assert
        $this->assertEquals("1", $output);
    }

    public function testShouldProcessNumber()
    {
        $fizzBuzz = new FizzBuzz;
        $this->assertEquals("1", $fizzBuzz->processNumber(1));
        $this->assertEquals("2", $fizzBuzz->processNumber(2));
        $this->assertEquals("Fizz", $fizzBuzz->processNumber(3));
        $this->assertEquals("Buzz", $fizzBuzz->processNumber(5));
        $this->assertEquals("Fizz", $fizzBuzz->processNumber(6));
        $this->assertEquals("FizzBuzz", $fizzBuzz->processNumber(15));
    }

    public function testShouldExecute() {
        $fizzBuzz = new FizzBuzz;
        $this->assertEquals("1", $fizzBuzz->execute([1]));
    }
}
