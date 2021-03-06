<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

class TextareaViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\TextareaViewHelper {
    public function initializeArguments() {
        parent::initializeArguments();

        $this->overrideArgument('errorClass', 'string', 'CSS class to set if there are errors for this view helper', FALSE, 'is-invalid');
    }
}