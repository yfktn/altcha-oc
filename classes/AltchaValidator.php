<?php namespace Yfktn\Altcha\Classes;

use AltchaOrg\Altcha\Altcha;
use Exception;
use Log;

class AltchaValidator implements \Illuminate\Contracts\Validation\Rule
{
    protected $attributeName = 'altcha';

    public function __construct($attributeName = 'altcha')
    {
        $this->attributeName = $attributeName;
    }

    public function message() 
    { 
        return 'The Altcha field is not valid.';
    }

    public function passes($attribute, $value)
    {
        $altchaHMACKey = config('yfktn.altcha::altchaHMACKey');
        $payload = post($this->attributeName);
        // trace_log($payload);
        if(empty($payload)) {
            // trace_log("Payload empty!");
            return false;
        }
        
        try {
            $decodedPayload = base64_decode($payload);
            $payload = json_decode($decodedPayload, true);

            $verified = Altcha::verifySolution($payload, $altchaHMACKey, true);
            if(!$verified) {
                return false;
            }
        } catch (Exception $e) {
            $errorId = date("YmdHis") . rand(1000, 9999);
            Log::error( 'ID: ' . $errorId . "\nAltcha Failed To Validate Request: " 
                . $e->getMessage() . "\n" 
                . $e->getTraceAsString());
            return false;
        }
        return true;
    }
}