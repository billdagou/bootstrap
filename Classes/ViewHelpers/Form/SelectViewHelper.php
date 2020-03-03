<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

class SelectViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\SelectViewHelper {
    public function initializeArguments() {
        parent::initializeArguments();

        $this->overrideArgument('errorClass', 'string', 'CSS class to set if there are errors for this view helper', FALSE, 'is-invalid');
    }
}