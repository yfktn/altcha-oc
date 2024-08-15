<?php namespace Yfktn\Altcha\Classes\Traits;

use AltchaOrg\Altcha\Altcha;
use AltchaOrg\Altcha\ChallengeOptions;
use Exception;
use Log;

trait ChallengerJsonAble
{
    public function getJsonChallenge(&$jsonChallenge = ''): bool
    {
        $challengeOptions = new ChallengeOptions([
            'hmacKey' => config('yfktn.altcha::altchaHMACKey'),
            'maxNumber' => config('yfktn.altcha::altchaMaxNumber'),
        ]);

        try {
            $challenge = Altcha::createChallenge($challengeOptions);
            $jsonChallenge = json_encode($challenge);
        } catch (Exception $e) {
            $errorId = date("YmdHis") . rand(1000, 9999);
            Log::error( 'ID: ' . $errorId . "\nAltcha Failed To Create Challenge: " 
                . $e->getMessage() . "\n" 
                . $e->getTraceAsString());
            $jsonChallenge = "Failed To Create Challenge ( Error ID: $errorId )";
            return false;
        }
        return true;
    }
}