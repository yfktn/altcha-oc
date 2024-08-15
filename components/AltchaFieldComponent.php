<?php namespace Yfktn\Altcha\Components;

use Cms\Classes\ComponentBase;
use Yfktn\Altcha\Classes\Traits\ChallengerJsonAble;

/**
 * AltchaFieldComponent Component
 */
class AltchaFieldComponent extends ComponentBase
{
    use ChallengerJsonAble;
    public $altchaFieldData = [];

    public function componentDetails()
    {
        return [
            'name' => 'AltchaFieldComponent',
            'description' => 'The Altcha Field Component'
        ];
    }

    public function defineProperties()
    {
        return [
            'challengeUrl' => [
                'title' => 'Challenge URL API',
                'description' => 'Your Server Challenge URL API',
                'type' => 'string',
                'default' => '#'
            ],
            'fieldName' => [
                'title' => 'Altcha Field Name',
                'description' => 'Name of your altcha field',
                'type' => 'string',
                'default' => 'altcha'
            ],
        ];
    }

    protected function loadAssets()
    {
        $this->addJs('/plugins/yfktn/altcha/assets/altcha.min.js', [
            'type' => 'module',
            'defer' => true
        ]);
    }

    public function onRun()
    {
        $this->loadAssets();
        $this->altchaFieldData['fieldName'] = $this->property('fieldName', 'altcha');
        $this->altchaFieldData['challengeMode'] = 'json';
        if(!empty($this->property('challengeUrl')) && $this->property('challengeUrl') != '#') {
            $this->altchaFieldData['challengeMode'] = 'url';
        }
        if($this->altchaFieldData['challengeMode'] == 'url') {
            $this->altchaFieldData['challengeUrl'] = $this->property('challengeUrl');   
        } else {
            $this->getJsonChallenge($this->altchaFieldData['challengeJson']);
        }

    }
}
