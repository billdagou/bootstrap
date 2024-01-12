<?php
namespace Dagou\Bootstrap\ViewHelpers\Uri;

use Dagou\Bootstrap\Source\Local;
use Dagou\Bootstrap\Interfaces\Source;
use Dagou\Bootstrap\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CssViewHelper extends AbstractViewHelper {
    protected static array $builds = [
        'grid',
        'reboot',
        'utilities',
    ];

    public function initializeArguments(): void {
        $this->registerArgument('build', 'string', 'Build name');
        $this->registerArgument('rtl', 'boolean', 'Enable RTL', FALSE, FALSE);
        $this->registerArgument('forceLocal', 'boolean', 'Force to use local source.');
    }

    /**
     * @return string
     */
    public function render(): string {
        if ($this->arguments['forceLocal'] !== TRUE
            && is_subclass_of(($className = ExtensionUtility::getSource()), Source::class)
        ) {
            $source = GeneralUtility::makeInstance($className);
        } else {
            $source = GeneralUtility::makeInstance(Local::class);
        }

        $build = in_array($this->arguments['build'], self::$builds) ? $this->arguments['build'] : '';

        return $source->getCss($build, $this->arguments['rtl']);
    }
}