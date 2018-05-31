<?php
namespace Dagou\Bootstrap\Traits;

use TYPO3\CMS\Core\Utility\GeneralUtility;

trait PageRenderer {
    /**
     * @var \TYPO3\CMS\Core\Page\PageRenderer
     */
    protected static $pageRenderer;

    /**
     * @return \TYPO3\CMS\Core\Page\PageRenderer
     */
    protected function getPageRenderer() {
        if (self::$pageRenderer === NULL) {
            self::$pageRenderer = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
        }

        return self::$pageRenderer;
    }
}