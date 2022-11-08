<?php
namespace Dagou\Bootstrap\Interfaces;

interface Source {
    const VERSION = '5.2.2';

    /**
     * @return string
     */
    public function getCss(): string;

    /**
     * @return string
     */
    public function getJs(): string;
}