<?php
namespace Dagou\Bootstrap\Source;

use Dagou\Bootstrap\Interfaces\Source;
use Dagou\Bootstrap\Traits\ExtConf;
use TYPO3\CMS\Core\SingletonInterface;

abstract class AbstractSource implements Source, SingletonInterface {
    use ExtConf;

    const URL = '';

    /**
     * @return string
     */
    public function getCss(): string {
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
     * @return string
     */
    public function getJs(): string {
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