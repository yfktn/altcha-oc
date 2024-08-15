<?php

return [
    'altchaHMACKey' => env('ALTCHA_HMAC_KEY', ''),
    'altchaMaxNumber' => env('ALTCHA_MAX_NUMBER', 50000),
    // in x seconds altcha challenge would be expired!
    'altchaExpired' => env('ALTCHA_EXPIRED', 30),
];