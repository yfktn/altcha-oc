<?php namespace Yfktn\Altcha;

use Backend;
use System\Classes\PluginBase;

/**
 * Altcha Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Altcha',
            'description' => 'October CMS Altcha Plugins',
            'author'      => 'Yfktn',
            'icon'        => 'icon-puzzle-piece'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Yfktn\Altcha\Components\AltchaFieldComponent' => 'altchaField',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'yfktn.altcha.some_permission' => [
                'tab' => 'Altcha',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'altcha' => [
                'label'       => 'Altcha',
                'url'         => Backend::url('yfktn/altcha/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['yfktn.altcha.*'],
                'order'       => 500,
            ],
        ];
    }
}
