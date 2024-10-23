<?php

use Morilog\Jalali\Jalalian;

function convert_digits_to_persian($str): string
{
    $farsi_chars = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $latin_chars = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    return str_replace($latin_chars, $farsi_chars, $str);
}

function format_number_with_commas($number, $decimals = 2, $decimal_point = '.', $thousands_separator = ',')
{
    // Check if the number is a whole number
    if (floor($number) == $number) {
        // If it's a whole number, format it without decimals
        return number_format($number, 0, $decimal_point, $thousands_separator);
    }

    // Truncate the number to given number of decimal places without rounding
    $truncatedNumber = floor($number * pow(10, $decimals)) / pow(10, $decimals);

    // Format the number with the specified number of decimals
    return number_format($truncatedNumber, $decimals, $decimal_point, $thousands_separator);
}

