<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use Dagou\Bootstrap\Traits\OverrideClassAttribute;
use Dagou\Bootstrap\Traits\OverrideErrorClassArgument;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class RangeViewHelper extends AbstractFormFieldViewHelper {
    use OverrideClassAttribute, OverrideErrorClassArgument;

    /**
     * @var string
     */
    protected $tagName = 'input';

    public function initializeArguments() {
        parent::initializeArguments();
        $this->overrideErrorClassArgument();
        $this->registerTagAttribute('min', 'int', 'Min value');
        $this->registerTagAttribute('max', 'int', 'Max value');
        $this->registerTagAttribute('step', 'float', 'Step value');
        $this->registerUniversalTagAttributes();
        $this->overrideClassAttribute('form-range');
    }

    /**
     * @return string
     */
    public function render(): string {
        $name = $this->getName();
        $this->registerFieldNameForFormTokenGeneration($name);
        $this->setRespectSubmittedDataValue(true);

        $this->tag->addAttribute('type', 'range');
        $this->tag->addAttribute('name', $name);
        $this->tag->addAttribute('value', $this->getValueAttribute());

        $this->addAdditionalIdentityPropertiesIfNeeded();
        $this->setErrorClassAttribute();

        return $this->tag->render();
    }
}