<?php
namespace Dagou\Bootstrap\Traits;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

trait Asset {
    /**
     * @param string $path
     *
     * @return string
     */
    protected function getAssetPath(string $path) {
        if (preg_match('/^(https?:)?\/\//i', $path)) {
            return $path;
        } elseif (strpos($path, 'EXT:') === 0) {
            list($extKey, $path) = explode('/', substr($path, 4), 2);

            return ExtensionManagementUtility::siteRelPath($extKey).$path;
        } else {
            return $path;
        }
    }
}