Acme\DemoDriver
===

What to remember
-------

 1. Create a new plugin

    ```php artisan create:plugin Acme.DemoDriver```

 2. Plugin should require Filipac/TwoFactor
 
    ```protected $requires = [ 'filipac/TwoFactor' ];```

 3. Register the driver class & name + valdation rules (optional)
 
 ```php
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
    ```

 4. Register required settings fieds (api keys etc)
 ```php
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
    ```

Now you should see this driver in the dropdown list in the TwoFactor settings page. 
**Activate** it and you're done. You use your custom newly created driver.
