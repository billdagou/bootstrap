<?php
namespace Dagou\Bootstrap\Interfaces;

interface Source {
    /**
     * @param string $build
     * @param bool $rtl
     *
     * @return string
     */
    public function getCss(string $build, bool $rtl): string;

    /**
     * @param string $build
     *
     * @return string
     */
    public function getJs(string $build): string;
}