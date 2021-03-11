<?php
namespace Dagou\Bootstrap\ViewHelpers;

use Dagou\Bootstrap\Source\Local;
use Dagou\Bootstrap\Interfaces\Source;
use Dagou\Bootstrap\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\ViewHelpers\Asset\CssViewHelper;

class LoadCssViewHelper extends CssViewHelper {
    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('disableSource', 'boolean', 'Disable Source.', FALSE, FALSE);
        $this->overrideArgument(
            'identifier',
            'string',
            'Use this identifier within templates to only inject your CSS once, even though it is added multiple times.',
            FALSE,
            'bootstrap'
        );
    }

    /**
     * @return string
     */
    public function render(): string {
        if (!$this->arguments['href']) {
            if (!$this->arguments['disableSource']
                && ($className = ExtensionUtility::getSource())
                && is_subclass_of($className, Source::class)
            ) {
                $source = GeneralUtility::makeInstance($className);
            } else {
                $source = GeneralUtility::makeInstance(Local::class);
            }

            $this->tag->addAttribute('href', $source->getCss());
        }

        return parent::render();
    }
}