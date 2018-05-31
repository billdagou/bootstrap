<?php
namespace Dagou\Bootstrap\Cdn;

use Dagou\Bootstrap\Traits\Asset;

class Bootstrap extends AbstractCdn {
    use Asset;
    const URL = '//stackpath.bootstrapcdn.com/bootstrap/';

    /**
     * @param string|NULL $css
     */
    public function loadCss(string $css = NULL) {
        parent::loadCss(
            self::URL.self::VERSION.'/css/'.$this->getCssPackage($this->getExtConf())
        );
    }

    /**
     * @param string|NULL $js
     * @param bool $footer
     */
    public function loadJs(string $js = NULL, bool $footer = TRUE) {
        parent::loadJs(
            self::URL.self::VERSION.'/js/'.$this->getJsPackage($this->getExtConf()),
            $footer
        );
    }
}