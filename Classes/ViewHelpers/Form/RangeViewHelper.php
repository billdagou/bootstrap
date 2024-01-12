<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

class RangeViewHelper extends InputViewHelper {
    protected string $type = 'range';

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerTagAttribute('min', 'int', 'Min value');
        $this->registerTagAttribute('max', 'int', 'Max value');
        $this->registerTagAttribute('step', 'float', 'Step value');

        $this->overrideClassAttribute('form-range');
    }
}