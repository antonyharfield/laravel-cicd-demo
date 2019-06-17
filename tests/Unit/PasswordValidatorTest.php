<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\PasswordValidator;

class PasswordValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void {
        parent::setUp();
        $this->validator = new PasswordValidator;
    }

    public function testValidPassword() {
        // Act
        $result = $this->validator->check('The8igC0d');

        // Assert
        $this->assertTrue($result);
    }

    public function testInvalidLessThan8Chars() {
        // Act
        $result = $this->validator->check('The8igC');

        // Assert
        $this->assertFalse($result);
    }

    public function testInvalidLessThan1Digit() {
        // Act
        $result1 = $this->validator->check('TheBigC');
        $result2 = $this->validator->check('TheBigCod');

        // Assert
        $this->assertFalse($result1);
        $this->assertFalse($result2);
    }
}

