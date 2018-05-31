<?php
namespace Dagou\Bootstrap\Traits;

trait Size {
    /**
     * @var array
     */
    protected static $sizes = [
        'lg',
        'sm',
    ];

    /**
     * @param string $size
     *
     * @return bool
     */
    protected function isValidSize(string $size) {
        return in_array($size, self::$sizes);
    }
}