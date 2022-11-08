<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

class EmailViewHelper extends TextfieldViewHelper {
    public function initializeArguments() {
        parent::initializeArguments();

        $this->overrideArgument('type', 'string', 'The field type', FALSE, 'email');
    }
}