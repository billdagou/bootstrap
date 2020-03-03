<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

class TextfieldViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper {
    public function initializeArguments() {
        parent::initializeArguments();

        $this->overrideArgument('errorClass', 'string', 'CSS class to set if there are errors for this view helper', FALSE, 'is-invalid');
    }
}