<?php
namespace Dagou\Bootstrap\Traits;

trait Context {
    /**
     * @var array
     */
    protected static $contexts = [
        'primary',
        'secondary',
        'success',
        'danger',
        'warning',
        'info',
        'light',
        'dark',
    ];

    /**
     * @param string $context
     *
     * @return bool
     */
    protected function isValidContext(string $context) {
        return in_array($context, self::$contexts);
    }
}