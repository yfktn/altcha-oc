<?php namespace Yfktn\Altcha\Controllers;

use Yfktn\Altcha\Classes\Traits\ChallengerUrlAble;

class Challenger extends \Backend\Classes\Controller
{
    use ChallengerUrlAble;
    
    public $publicActions = ['getchallenge'];

    public function __construct()
    {
        parent::__construct();
    }
}