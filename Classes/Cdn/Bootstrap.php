<?php
namespace Dagou\Bootstrap\Cdn;

class Bootstrap extends AbstractCdn {
    const URL = '//stackpath.bootstrapcdn.com/bootstrap/';

    /**
     * @param string|NULL $css
     */
    public function loadCss(string $css = NULL) {
        parent::loadCss(
            self::URL.self::VERSION.'/css/'.$this->getCss()
        );
    }

    /**
     * @param string|NULL $js
     * @param bool $footer
     */
    public function loadJs(string $js = NULL, bool $footer = TRUE) {
        parent::loadJs(
            self::URL.self::VERSION.'/js/'.$this->getJs(),
            $footer
        );
    }
}