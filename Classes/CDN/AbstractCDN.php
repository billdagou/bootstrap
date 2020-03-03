<?php
namespace Dagou\Bootstrap\CDN;

use Dagou\Bootstrap\Interfaces\CDN;
use Dagou\Bootstrap\Traits\ExtConf;
use Dagou\Bootstrap\Traits\PageRenderer;
use TYPO3\CMS\Core\SingletonInterface;

abstract class AbstractCDN implements CDN, SingletonInterface {
    use ExtConf, PageRenderer;
    const URL = '';

    /**
     * @param string|NULL $css
     */
    public function loadCss(string $css = NULL) {
        $css = $this->renderCss($css);

        $this->getPageRenderer()->addCssLibrary($css);
    }

    /**
     * @param string|NULL $css
     *
     * @return string
     */
    protected function renderCss(string $css = NULL): string {
        return static::URL.'css/'.$this->getCssBuild();
    }

    /**
     * @return string
     */
    protected function getCssBuild(): string {
        switch ($this->getExtConf('css')) {
            case 'default':
                return 'bootstrap.min.css';
            case 'grid':
                return 'bootstrap-grid.min.css';
            case 'reboot':
                return 'bootstrap-reboot.min.css';
        }
    }

    /**
     * @param string|NULL $js
     * @param bool $footer
     */
    public function loadJs(string $js = NULL, bool $footer = TRUE) {
        $js = $this->renderJs($js);

        if ($footer) {
            $this->getPageRenderer()->addJsFooterLibrary('bootstrap', $js);
        } else {
            $this->getPageRenderer()->addJsLibrary('bootstrap', $js);
        }
    }

    /**
     * @param string|NULL $js
     *
     * @return string
     */
    protected function renderJs(string $js = NULL): string {
        return static::URL.'js/'.$this->getJsBuild();
    }

    /**
     * @return string
     */
    protected function getJsBuild(): string {
        switch ($this->getExtConf('js')) {
            case 'default':
                return 'bootstrap.min.js';
            case 'bundle':
                return 'bootstrap.bundle.min.js';
        }
    }
}