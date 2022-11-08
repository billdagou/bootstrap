<?php
namespace Dagou\Bootstrap\ViewHelpers;

use Dagou\Bootstrap\Source\Local;
use Dagou\Bootstrap\Interfaces\Source;
use Dagou\Bootstrap\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CssViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Asset\CssViewHelper {
    /**
     * @var array
     */
    protected static $builds = [
        'grid',
        'reboot',
        'utilities',
    ];

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('build', 'string', 'Build name');
        $this->registerArgument('rtl', 'boolean', 'Enable RTL');
        $this->registerArgument('disableSource', 'boolean', 'Disable source');

        $this->overrideArgument(
            'identifier',
            'string',
            'Use this identifier within templates to only inject your CSS once, even though it is added multiple times.',
            FALSE
        );
    }

    /**
     * @return string
     */
    public function render(): string {
        if (!$this->arguments['href']) {
            if ($this->arguments['disableSource'] !== TRUE
                && is_subclass_of(($className = ExtensionUtility::getSource()), Source::class)
            ) {
                $source = GeneralUtility::makeInstance($className);
            } else {
                $source = GeneralUtility::makeInstance(Local::class);
            }

            $build = in_array($this->arguments['build'], self::$builds) ? $this->arguments['build'] : '';
            $rtl = $this->arguments['rtl'] === TRUE;

            $this->tag->addAttribute('href', $source->getCss($build, $rtl));
        }

        $this->arguments['identifier'] = 'bootstrap'.($build ? '.'.$build : '');

        return parent::render();
    }
}