<?php
namespace Dagou\Bootstrap\Interfaces;

interface CDN {
    const VERSION = '4.4.1';

    /**
     * @param string|NULL $css
     */
    public function loadCss(string $css = NULL);

    /**
     * @param string|NULL $js
     * @param bool $footer
     */
    public function loadJs(string $js = NULL, bool $footer = TRUE);
}