<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Hospital;
use App\Exceptions\ValidationException;

class HospitalModelTest extends TestCase
{

    public function testCreateModel()
    {
        // Arrange
        $name = 'Naresuan University Hospital';
        $address = '99 Moo 9 Thapho Muang Phitsanulok';
        $numberOfBeds = 5000;
        $numberOfDoctors = 333;

        // Act
        $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);
        
        // Assert
        $this->assertEquals($name, $hospital->name, 'Set hospital name');
        $this->assertEquals($address, $hospital->address, 'Set address');
        $this->assertEquals($numberOfBeds, $hospital->numberOfBeds, 'Set numberOfBeds');
        $this->assertEquals($numberOfDoctors, $hospital->numberOfDoctors, 'Set numberOfDoctors');
    }

    public function testNonNumericBedsAndDoctors() {
        // Act
        $hospital = Hospital::create('Phra Buddhachinarat', 'Phitsanulok', null, 'unknown');
        
        // Assert
        $this->assertEquals(0, $hospital->numberOfBeds, 'Null numberOfBeds should be 0');
        $this->assertEquals(0, $hospital->numberOfDoctors, 'String numberOfDoctors should be 0');
    }

    public function testInvalidNumericBedsAndDoctors() {
        // Act
        $hospital = Hospital::create('Phra Buddhachinarat', 'Phitsanulok', -50, 4.4);
        
        // Assert
        $this->assertEquals(0, $hospital->numberOfBeds, 'Negative numberOfBeds should be 0');
        $this->assertEquals(4, $hospital->numberOfDoctors, 'Float numberOfDoctors cast to int');
    }

    public function testEmptyNameThrows() {
        // Arrange
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid name');
        //$this->expectExceptionMessageRegExp('/name/');

        // Act
        $hospital = Hospital::create('', 'Phitsanulok', 100, 10);
    }
}
