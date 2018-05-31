<?php
namespace Dagou\Bootstrap\ViewHelpers;

use Dagou\Bootstrap\Cdn\Customization;
use Dagou\Bootstrap\Cdn\Local;
use Dagou\Bootstrap\Interfaces\Cdn;
use Dagou\Bootstrap\Traits\ExtConf;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

abstract class AbstractLoadViewHelper extends AbstractViewHelper {
    use ExtConf;

    /**
     * @param bool $isCustomized
     *
     * @return \Dagou\Bootstrap\Interfaces\Cdn
     */
    protected function getCdn(bool $isCustomized) {
        if ($isCustomized) {
            return GeneralUtility::makeInstance(Customization::class);
        }

        if (($cdnClassName = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN'][$this->getExtConf()['cdn']])) {
            $cdn = GeneralUtility::makeInstance($cdnClassName);

            return $cdn instanceof Cdn ? $cdn : GeneralUtility::makeInstance(Local::class);
        } else {
            return GeneralUtility::makeInstance(Local::class);
        }
    }
}