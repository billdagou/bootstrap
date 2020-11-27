<?php
namespace Dagou\Bootstrap\ViewHelpers;

use Dagou\Bootstrap\CDN\Customization;
use Dagou\Bootstrap\CDN\Local;
use Dagou\Bootstrap\Interfaces\CDN;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

abstract class AbstractLoadViewHelper extends AbstractViewHelper {
    public function initializeArguments() {
        $this->registerArgument('disableCdn', 'boolean', 'Disable CDN.');
    }

    /**
     * @param bool $isCustomized
     *
     * @return \Dagou\Bootstrap\Interfaces\CDN
     */
    protected function getCDN(bool $isCustomized): CDN {
        if ($isCustomized) {
            return GeneralUtility::makeInstance(Customization::class);
        }

        if ($this->isCdnEnabled() && ($className = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN']) && is_subclass_of($className, CDN::class)) {
            return GeneralUtility::makeInstance($className);
        } else {
            return GeneralUtility::makeInstance(Local::class);
        }
    }

    /**
     * @return bool
     */
    protected function isCdnEnabled(): bool {
        return !$this->arguments['disableCdn'];
    }
}