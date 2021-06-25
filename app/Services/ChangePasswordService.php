<?php

namespace App\Services;

use App\Base\Util\BaseUtil;

class ChangePasswordService
{
    /**
     * @var BaseUtil
     */
    private $baseUtil;

    public function __construct(BaseUtil $baseUtil)
    {
        $this->baseUtil = $baseUtil;
    }

    /*
    As minimum requirements for user passwords, the following should be considered:
    Minimum length of 8 characters;
    Presence of at least 3 of the 4 character classes below:
        uppercase characters;
        lowercase characters;
        numbers;
        special characters;
        Absence of strings (eg: 1234) or consecutive identical characters (yyyy);
        Absence of any username identifier, such as: John Silva - user: john.silva - password cannot contain "john" or "silva".
    */
    public function validatePassword(string $login, string $senha): bool
    {
        if (strlen($senha) >= 8) {
            $letterUppercase = "/[A-Z]/";
            $letterLowercase = "/[a-z]/";
            $digit = "/[0-9]/";
            $special = "/[!@#$%&*()_+=|<>?{}\\[\\]~-]/";

            $U = preg_match($letterUppercase, $senha);
            $L = preg_match($letterLowercase, $senha);
            $D = preg_match($digit, $senha);
            $S = preg_match($special, $senha);

            $hasChars = ($U && $L && $D) || ($S && $U && $L) || ($D && $S && $U) || ($L && $D && $S);

            return $hasChars
                    && !$this->baseUtil->containsNumericSequences(4,9, $senha)
                    && !$this->baseUtil->containsConsecutiveIdenticalCharacters(4,9, $senha)
                    && !str_contains($senha, $login);

        } else
            return false;
    }

}
