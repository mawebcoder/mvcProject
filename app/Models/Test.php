<?php

namespace App\Models;

class Test
{

    public static string $firstName='ali';

    public static string $lastName;


    public static function setFirstName(string $firstName)
    {
        self::$firstName = $firstName;

        return new static();
    }

    public function setLastName(string $lastName)
    {
        self::$lastName = $lastName;

        return new static();
    }

    public function getFullName()
    {
        echo self::$firstName . " " . self::$lastName;
    }

}