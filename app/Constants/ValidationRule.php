<?php

namespace App\Constants;

class ValidationRule
{
    const USERNAME = ['min:1', 'max:100', 'regex:' . Regex::LATIN_NUMBERS_SPECIAL_CHARACTERS];
}
