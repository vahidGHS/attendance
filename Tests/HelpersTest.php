<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../includes/helpers.php';

class HelpersTest extends TestCase
{
    // public function testStudentCodeValid()
    // {
    //     $this->assertTrue(validateStudentCode("40123456"));
    // }

    // public function testStudentCodeInvalid()
    // {
    //     $this->assertFalse(validateStudentCode("ABC123"));
    // }

    // public function testTeacherCodeValid()
    // {
    //     $this->assertTrue(validateTeacherCode("12345"));
    // }

    // public function testTeacherCodeInvalid()
    // {
    //     $this->assertFalse(validateTeacherCode("AA123"));
    // }
//========================دانش آموز
    public function test100StudentCodes()
    {
        for ($i = 0; $i < 100; $i++) {

            $code = (string)(40100000 + $i);

            $this->assertTrue(
                validateStudentCode($code)
            );
        }
    }
    public function test100InvalidStudentCodes()
    {
        for ($i = 0; $i < 100; $i++) {

            $code = "AB" . $i;

            $this->assertFalse(
                validateStudentCode($code)
            );
        }
    }
    //-----------------------استاد
    public function test100InvalidTeacherCodes()
{
    for($i=0;$i<100;$i++){

        $code = "AB".$i;

        $this->assertFalse(
            validateTeacherCode($code)
        );

    }
}

    public function test100TeacherCodes()
    {
        for ($i = 0; $i < 100; $i++) {

            $code = (string)(40100000 + $i);

            $this->assertTrue(
                validateTeacherCode($code)
            );
        }
    }
}
