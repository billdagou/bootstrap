<?php
namespace Dagou\Bootstrap\Cdn;

use Dagou\Bootstrap\Traits\Asset;

class Customization extends AbstractCdn {
    use Asset;

    /**
     * @param string|NULL $css
     */
    public function loadCss(string $css = NULL) {
        if ($css !== NULL) {
            parent::loadCss($this->getAssetPath($css));
        }
    }

    /**
     * @param string|NULL $js
     * @param bool $footer
     */
    public function loadJs(string $js = NULL, bool $footer = TRUE) {
        if ($js !== NULL) {
            parent::loadJs($this->getAssetPath($js), $footer);
        }
    }
}