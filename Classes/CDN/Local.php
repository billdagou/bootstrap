<?php
namespace Dagou\Bootstrap\CDN;

use Dagou\Bootstrap\Traits\Asset;

class Local extends AbstractCDN {
    use Asset;
    const URL = 'EXT:bootstrap/Resources/Public/';

    /**
     * @param string|NULL $css
     *
     * @return string
     */
    protected function renderCss(string $css = NULL): string {
        return $this->getAssetPath(
            self::URL.'css/'.$this->getCssBuild()
        );
    }

    /**
     * @param string|NULL $js
     *
     * @return string
     */
    protected function renderJs(string $js = NULL): string {
        return $this->getAssetPath(
            self::URL.'js/'.$this->getJsBuild()
        );
    }
}