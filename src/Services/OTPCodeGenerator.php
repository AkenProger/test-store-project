<?php

namespace App\Services;

class OTPCodeGenerator
{
    public final function generate(): int
    {
        return rand(1000, 9000);
    }
}