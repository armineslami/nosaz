<?php

use Morilog\Jalali\Jalalian;

function convert_digits_to_persian($str): string {
    $farsi_chars = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    $latin_chars = ['0','1','2','3','4','5','6','7','8','9'];
    return str_replace($latin_chars, $farsi_chars, $str);
}
