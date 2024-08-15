<?php namespace Yfktn\Altcha\Components;

use Backend;
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
                'default' => Backend::url('yfktn/altcha/challenger/getchallenge')
            ],
            // 'expire' => [
            //     'title' => 'Challenge Expiration',
            //     'description' => 'Challenge Expiration in milliseconds',
            //     'type' => 'string',
            //     'default' => 0,  
            // ],
            'fieldName' => [
                'title' => 'Altcha Field Name',
                'description' => 'Name of your altcha field',
                'type' => 'string',
                'default' => 'altcha'
            ],
            'floating' => [
                'title' => 'Enable the floating UI',
                'description' => 'Enable the floating UI',
                'type' => 'dropdown',
                'placeholder' => 'Select floating UI',
                'options' => [ 'none' => 'None', 'auto' => 'Auto', 'top' => 'Top', 'bottom' => 'Bottom'],
                'default' => 'none',
            ],
            'hideFooter' => [
                'title' => 'Hide Footer',
                'description' => 'Hide the footer (ALTCHA link)',
                'type' => 'checkbox',
                'default' => false
            ],
            'hideLogo' => [
                'title' => 'Hide Logo',
                'description' => 'Hide the Altcha Logo',
                'type' => 'checkbox',
                'default' => false
            ]

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
        $this->altchaFieldData['csrfToken'] = csrf_token();
        // $this->altchaFieldData['expire'] = $this->property('expire', 0);
        $this->altchaFieldData['floating'] = $this->property('floating', 'none');
        $this->altchaFieldData['hideFooter'] = $this->property('hideFooter', false);
        $this->altchaFieldData['hideLogo'] = $this->property('hideLogo', false);
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
