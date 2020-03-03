<?php
namespace Dagou\Bootstrap\Traits;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

trait Asset {
    /**
     * @param string $path
     *
     * @return string
     */
    protected function getAssetPath(string $path): string {
        if (preg_match('/^(https?:)?\/\//i', $path)) {
            return $path;
        } else {
            return PathUtility::getAbsoluteWebPath(
                GeneralUtility::getFileAbsFileName($path)
            );
        }
    }
}