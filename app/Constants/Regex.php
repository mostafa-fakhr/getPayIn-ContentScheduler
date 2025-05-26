<?php

namespace App\Constants;

/**
 * Description of common validation Regex
 */
class Regex
{
    const PASSWORD = '/^[a-zA-Z0-9-_~!@,;\[\]`\-~\'\"\|:{}\\?#+=$*%^&()<>.\\/\\\\ ]*$/';
    const LATIN_NUMBERS_SPECIAL_CHARACTERS = '/^[\p{Latin}0-9,.{}:\[\]•„"“”‘’´–\-?_\'@!|+&~—;*\/$™©®#%)(<>\^`،−\\\\ \x{a0}]*$/u';
}
