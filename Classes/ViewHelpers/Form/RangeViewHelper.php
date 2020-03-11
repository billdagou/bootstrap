<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class RangeViewHelper extends AbstractFormFieldViewHelper {
    /**
     * @var string
     */
    protected $tagName = 'input';

    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this view helper', FALSE, 'is-invalid');
        $this->registerTagAttribute('min', 'int', 'Min value');
        $this->registerTagAttribute('max', 'int', 'Max value');
        $this->registerTagAttribute('step', 'float', 'Step value');
        $this->registerUniversalTagAttributes();
    }

    /**
     * @return string
     */
    public function render() {
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