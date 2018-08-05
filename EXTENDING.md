# Extending the Toast Class

If you want to customize or add more feature to this package, you can simply extend the Toast class and create your own.
```php
use Tegimus\IziToast\Toast;

class MyToast extends Toast {

    public function __construct(...$params) {
        parent::__construct(...$params);
    }

}
```

Once you extend the class, you can easily change the default behaviour like in the examples given below.

##### Set default options
To change the default options, you can override the defaultOptions() method and return an array with desired default options.
```php
protected function defaultOptions() {
    return [
        'closeOnEscape' => true,
        'closeOnClick' => true,
        'position' => 'topCenter',
        'progressBar' => false,
        'transitionIn' => 'bounceInLeft',
    ];
}
```

##### Change output
To change the output rendered in HTML, override the js() method.

For eaxmple if you want to automatically wrap the output in a <script> tag instead of manually doing that in HTML:
```php
protected function js() {
    return '<script>' . parent::js() . '</script>';
}
```
