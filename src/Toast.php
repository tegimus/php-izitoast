<?php

namespace Tegimus\IziToast;

/**
 * A simple php wrapper for the iziToast javascript library
 * http://izitoast.marcelodolce.com/
 *
 * @author tegimus@gmail.com
 * http://www.tegimus.com
 */
class Toast {

    const TYPE_GENERAL = 'show';
    const TYPE_INFO = 'info';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';
    const TYPE_QUESTION = 'question';

    protected $type;
    protected $options;

    /**
     * Constructor
     *
     * @param string $message
     * @param string $title
     * @param string $type
     * @param array $options
     */
    public function __construct($message = '', $title = '', $type = self::TYPE_INFO, $options = []) {
        //set toast type
        $this->type($type);

        //populate toast options
        $this->options($this->defaultOptions());
        $this->option('message', $message);
        $this->option('title', $title);
        $this->mergeOptions($options);
    }

    /**
     * __toString magic method
     *
     * @return string
     */
    public function __toString() {
        return $this->js();
    }

    /**
     * Static alias for constructor
     */
    public static function make(...$params) {
        return new static(...$params);
    }

    /**
     * Set the toast type
     *
     * @param string $type
     */
    public function type($type) {
        $this->type = $type;
    }

    /**
     * Return array with default toast options
     *
     * @return array
     */
    protected function defaultOptions() {
        return [
            'closeOnEscape' => true,
            'closeOnClick' => true,
            'position' => 'topCenter',
            'progressBar' => false,
            'transitionIn' => 'bounceInLeft',
        ];
    }

    /**
     * Merge current options with new array. If keys exists in current array, values will be overwritten by new ones
     *
     * @param array $options
     */
    public function mergeOptions(array $options) {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * If value is given, set the option to the given value
     * If value is not given, read the current option value
     *
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function option($key, $value = null) {
        if (is_null($value)) {
            $return = $this->options[$key] ?? null;
        }
        else {
            $this->options[$key] = $value;
            $return = true;
        }

        return $return;
    }

    /**
     * Overwrite the current options with the options provided
     *
     * @param array $options
     */
    public function options(array $options) {
        $this->options = $options;
    }

    /**
     * Unset an option. If key is not specified, clear all options
     *
     * @param string $key
     */
    public function clear($key = null) {
        if (is_null($key)) {
            $this->options([]);
        }

        if (isset($this->options[$key])) {
            unset($this->options[$key]);
        }
    }

    /**
     * Get the javascript code to show the toast
     *
     * @return string
     */
    protected function js() {
        $options = json_encode($this->options, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);

        return "iziToast.{$this->type}({$options});";
    }

    /**
     * Render the javascript output
     */
    public function render() {
        echo $this->js();
    }

}
