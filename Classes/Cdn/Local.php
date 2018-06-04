<?php
namespace Dagou\Bootstrap\Cdn;

use Dagou\Bootstrap\Traits\Asset;

class Local extends AbstractCdn {
    use Asset;
    const URL = 'EXT:bootstrap/Resources/Public/';

    /**
     * @param string|NULL $css
     */
    public function loadCss(string $css = NULL) {
        parent::loadCss(
            $this->getAssetPath(
                self::URL.'css/'.$this->getCss()
            )
        );
    }

    /**
     * @param string|NULL $js
     * @param bool $footer
     */
    public function loadJs(string $js = NULL, bool $footer = TRUE) {
        parent::loadJs(
            $this->getAssetPath(
                self::URL.'js/'.$this->getJs()
            ),
            $footer
        );
    }
}