<?php
namespace Dagou\Bootstrap\Source;

use Dagou\Bootstrap\Interfaces\Source;
use TYPO3\CMS\Core\SingletonInterface;

abstract class AbstractSource implements Source, SingletonInterface {
    protected const URL = '';

    /**
     * @param string $build
     * @param bool $rtl
     *
     * @return string
     */
    public function getCss(string $build = '', bool $rtl = FALSE): string {
        return static::URL.'css/'.$this->getCssBuild($build, $rtl);
    }

    /**
     * @param string $buildName
     * @param bool $enableRTL
     *
     * @return string
     */
    protected function getCssBuild(string $buildName, bool $enableRTL): string {
        return 'bootstrap'.($buildName ? '-'.$buildName : '').($enableRTL ? '.rtl' : '').'.min.css';
    }

    /**
     * @param string $build
     *
     * @return string
     */
    public function getJs(string $build = ''): string {
        return static::URL.'js/'.$this->getJsBuild($build);
    }

    /**
     * @param string $buildName
     *
     * @return string
     */
    protected function getJsBuild(string $buildName): string {
        return 'bootstrap'.($buildName ? '.'.$buildName : '').'.min.js';
    }
}