<?php

function validateStudentCode($code)
{
    return preg_match('/^[0-9]{8,12}$/', trim($code)) === 1;
}

function validateTeacherCode($code)
{
    return preg_match('/^[0-9]{4,10}$/', trim($code)) === 1;
}

