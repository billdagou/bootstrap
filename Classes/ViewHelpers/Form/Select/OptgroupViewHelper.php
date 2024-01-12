<?php
namespace Dagou\Bootstrap\ViewHelpers\Form\Select;

use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class OptgroupViewHelper extends AbstractFormFieldViewHelper {
    /**
     * @var string
     */
    protected $tagName = 'optgroup';

    public function initializeArguments(): void {
        $this->registerUniversalTagAttributes();

        $this->registerArgument('additionalAttributes', 'array', 'Additional tag attributes. They will be added directly to the resulting HTML tag.');
        $this->registerArgument('data', 'array', 'Additional data-* attributes. They will each be added with a "data-" prefix.');
        $this->registerTagAttribute('label', 'string', 'Human-readable label property for the generated optgroup tag');
        $this->registerTagAttribute('disabled', 'boolean', 'If true, option group is rendered as disabled', FALSE, FALSE);
    }

    /**
     * @return string
     */
    public function render(): string {
        if ($this->arguments['disabled']) {
            $this->tag->addAttribute('disabled', 'disabled');
        } else {
            $this->tag->removeAttribute('disabled');
        }

        $this->tag->setContent($this->renderChildren());

        return $this->tag->render();
    }
}