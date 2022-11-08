<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

class UrlViewHelper extends TextfieldViewHelper {
    public function initializeArguments() {
        parent::initializeArguments();

        $this->overrideArgument('type', 'string', 'The field type', FALSE, 'url');
    }
}