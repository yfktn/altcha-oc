<?php namespace Yfktn\Altcha\Classes\Traits;

use AltchaOrg\Altcha\Altcha;
use AltchaOrg\Altcha\ChallengeOptions;
use Exception;
use Log;

trait ChallengerUrlAble
{
    use ChallengerJsonAble;
    public function getChallenge()
    {
        $response ='';

        $csrfToken = csrf_token();
        $csrfRequestToken  = input('_token');
        if(empty($csrfRequestToken) || $csrfRequestToken != $csrfToken) {
            return response('Invalid request token', 500);
        }
        
        if(!$this->getJsonChallenge($response)) {
            return response($response, 500);
        }

        return response($response, 200)
            ->withHeaders(['Content-Type' => 'application/json']);
    }

}