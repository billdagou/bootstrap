<?php
namespace Dagou\Bootstrap\Utility;

class ExtensionUtility {
    /**
     * @param string $sourceClassName
     */
    public static function registerSource(string $sourceClassName) {
        $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['Source'] = $sourceClassName;
    }

    /**
     * @return string
     * @internal
     */
    public static function getSource(): string {
        return $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['Source'] ?? '';
    }
}