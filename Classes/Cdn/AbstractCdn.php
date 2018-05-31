<?php
namespace Dagou\Bootstrap\Cdn;

use Dagou\Bootstrap\Interfaces\Cdn;
use Dagou\Bootstrap\Traits\ExtConf;
use Dagou\Bootstrap\Traits\PageRenderer;
use TYPO3\CMS\Core\SingletonInterface;

abstract class AbstractCdn implements Cdn, SingletonInterface {
    use ExtConf, PageRenderer;

    /**
     * @param string $css
     */
    public function loadCss(string $css = NULL) {
        $this->getPageRenderer()->addCssLibrary($css);
    }

    /**
     * @param string $js
     * @param bool $footer
     */
    public function loadJs(string $js = NULL, bool $footer = TRUE) {
        if ($footer) {
            $this->getPageRenderer()->addJsFooterLibrary('bootstrap', $js);
        } else {
            $this->getPageRenderer()->addJsLibrary('bootstrap', $js);
        }
    }

    /**
     * @param array $extConf
     *
     * @return string
     */
    protected function getCssPackage(array $extConf) {
        switch ($extConf['css']) {
            case 'default':
                return 'bootstrap.min.css';
            case 'grid':
                return 'bootstrap-grid.min.css';
            case 'reboot':
                return 'bootstrap-reboot.min.css';
        }
    }

    /**
     * @param array $extConf
     *
     * @return string
     */
    protected function getJsPackage(array $extConf) {
        switch ($extConf['css']) {
            case 'default':
                return 'bootstrap.min.js';
            case 'bundle':
                return 'bootstrap.bundle.min.css';
        }
    }
}