<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

class RangeViewHelper extends TextfieldViewHelper {
    public function initializeArguments() {
        parent::initializeArguments();

        $this->registerTagAttribute('min', 'int', 'Min value');
        $this->registerTagAttribute('max', 'int', 'Max value');
        $this->registerTagAttribute('step', 'float', 'Step value');

        $this->overrideClassAttribute('form-range');
        $this->overrideArgument('type', 'string', 'The field type', FALSE, 'range');
    }
}