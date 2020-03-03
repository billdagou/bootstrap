<?php
namespace Dagou\Bootstrap\Traits;

use TYPO3\CMS\Core\Utility\GeneralUtility;

trait PageRenderer {
    /**
     * @return \TYPO3\CMS\Core\Page\PageRenderer
     */
    protected function getPageRenderer(): \TYPO3\CMS\Core\Page\PageRenderer {
        return GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
    }
}