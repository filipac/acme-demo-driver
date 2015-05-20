<?php namespace Acme\DemoDriver;

use System\Classes\PluginBase;

/**
 * DemoDriver Plugin Information File
 */
class Plugin extends PluginBase
{
    protected $requires = [ 'filipac/TwoFactor' ];

    public static $tab = 'Demo Driver';

    public function pluginDetails()
    {
        return [
            'name'        => 'TwoFactor Driver - Demo Driver',
            'description' => 'Just a quick demo on how you can extend TwoFactor PLugin',
            'author'      => 'Acme',
            'icon'        => 'icon-leaf'
        ];
    }

    public function register()
    {
        \Event::listen('filipac.twofactor.drivers', function() {
            return ['class' => 'Acme\DemoSender', 'name' => 'Demo DRIVER'];
        });
        \Filipac\TwoFactor\Models\Settings::extend(function(&$model) {
            $model->rules = $model->rules + ['demo_username'    => 'required_if:driver,'.DemoSender::class,
                                             'demo_password'  => 'required_if:driver,'.DemoSender::class,
                                             'demo_from'  => 'between:2,12|required_if:driver,'.DemoSender::class];
            $model->customMessages['demo_username.required_if'] = 'All the fields from Demo tab are required!';
            $model->customMessages['demo_password.required_if'] = 'All the fields from Demo tab are required!';
            $model->customMessages['demo_from.required_if'] = 'All the fields from Demo tab are required!';
        });
    }

    public function registerFields(){
        $arr = [];
        $arr['demo_username'] = [
            'label' => 'API Username',
            'tab' => self::$tab,
            'span' => 'auto'
        ];
        $arr['demo_password'] = [
            'label' => 'Api Password',
            'tab' => self::$tab,
            'span' => 'auto'
        ];
        $arr['demo_from'] = [
            'label' => 'From name',
            'comment' => 'Sample comment',
            'tab' => self::$tab,
            'span' => 'auto'
        ];
        return $arr;
    }

}
