# php-izitoast
A simple php wrapper for the iziToast javascript library

### Requirements
PHP 7 or greater

### Installation
##### Using Composer
```
composer require tegimus/php-izitoast
```

##### Manual
You can also use the package class file [src/Toast.php](src/Toast.php) directly in your project since it has no other dependencies.

### Adding the iziToast library files
Download the latest iziToast javascript and stylesheet files from [iziToast github repository](https://github.com/dolce/iziToast/archive/master.zip).

Add the iziToast css and js files to your html.
```html
<html>
    <head>
        ...
        <link rel="stylesheet" type="text/css" href="/path/to/css/iziToast.min.css">
        ...
    </head>
    <body>
        ...
        <script type="text/javascript" src="/path/to/js/iziToast.min.js"></script>
    </body>
</html>
```

### Basic Usage
##### Creating the Toast object
Using constructor
```php
use Tegimus\IziToast\Toast;

$toast = new Toast();
```
Or using the static make() method
```php
$toast = Toast::make();
```

##### Constructor Parameters
The constructor can optionally receive message, title, type and options parameters.
```php
$title = 'Test';
$message = 'My sample message';
$type = Toast::TYPE_SUCCESS;
$options = ['progressBar' => false];

$toast = new Toast($message);
//or
$toast = Toast:make($message, $title, $type, $options);
```

##### Display the message
To show the toast message, simply use the render() function on the Toast object inside javascript in your HTML.
```html
<script>
  <?php $toast->render() ?>
</script>
```
Or in string contexts you can simply echo the Toast object
```html
<script>
  <?= $toast ?>
</script>
```

### Customizing
##### Message types
You can set the type of the message by calling type() method on the Toast object.
```php
$toast->type(Toast::TYPE_ERROR);
```

##### Message options
By default, the Toast object will have the below options set.
```
'closeOnEscape' : true
'closeOnClick' : true
'position' : 'topCenter'
'progressBar' : false
'transitionIn' : 'bounceInLeft'
```

To override an option or to add a new one, use the option() method
```php
$toast->option('timeout', false);
```

Or specify multiple options at once
```php
$toast->mergeOptions([
  'position' => 'bottomRight',
  'timeout' => 6000,
  'pauseOnHover' => false,
]);
```

Or replace all options with the given array. All existing options will be cleared including message and title.
```php
$toast->options([
  'message' => 'Sample message',
  'title' => 'Replace',
  'position' => 'bottomRight',
  'timeout' => 6000,
  'pauseOnHover' => false,
]);
```

To clear an option use the clear() method. All options will be cleared if no parameter is specified.
```php
//clear 'position' option
$toast->clear('position');
//clear all options
$toast->clear();
```

All types and options available for the iziToast library are documented [here](http://izitoast.marcelodolce.com).

### Extending the Toast class
[Read here](README.md) to know more about extending and customizing the Toast class
