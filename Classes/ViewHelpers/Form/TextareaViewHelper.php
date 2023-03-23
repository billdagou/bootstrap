<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use Dagou\Bootstrap\Traits\OverrideClassAttribute;
use Dagou\Bootstrap\Traits\OverrideErrorClassArgument;

class TextareaViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\TextareaViewHelper {
    use OverrideClassAttribute, OverrideErrorClassArgument;

    public function initializeArguments() {
        parent::initializeArguments();

        $this->registerTagAttribute('autocomplete', 'string', 'Hint for form autofill feature');

        $this->overrideErrorClassArgument();
        $this->overrideClassAttribute('form-control');
    }
}