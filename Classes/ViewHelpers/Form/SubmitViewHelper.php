<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

class SubmitViewHelper extends ButtonViewHelper {
    public function initializeArguments() {
        parent::initializeArguments();

        $this->overrideTypeAttribute('submit');
    }
}