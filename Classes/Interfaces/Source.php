<?php
namespace Dagou\Bootstrap\Interfaces;

interface Source {
    const VERSION = '4.6.0';

    /**
     * @return string
     */
    public function getCss(): string;

    /**
     * @return string
     */
    public function getJs(): string;
}