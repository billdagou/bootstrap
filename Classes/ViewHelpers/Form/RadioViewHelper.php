<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use Dagou\Bootstrap\Traits\OverrideClassAttribute;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class RadioViewHelper extends AbstractFormFieldViewHelper {
    use OverrideClassAttribute;

    /**
     * @var string
     */
    protected $tagName = 'input';

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('checked', 'bool', 'Specifies that the input element should be preselected');
        $this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this ViewHelper', FALSE, 'is-invalid');
        $this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');

        $this->registerUniversalTagAttributes();

        $this->overrideArgument('value', 'string', 'Value of input tag. Required for radio buttons', TRUE);
        $this->overrideClassAttribute('form-check-input');
    }

    /**
     * @return string
     */
    public function render(): string {
        $checked = $this->arguments['checked'];

        $this->tag->addAttribute('type', 'radio');

        $nameAttribute = $this->getName();
        $valueAttribute = $this->getValueAttribute();

        $propertyValue = NULL;
        if ($this->hasMappingErrorOccurred()) {
            $propertyValue = $this->getLastSubmittedFormData();
        }
        if ($checked === NULL && $propertyValue === NULL) {
            $propertyValue = $this->getPropertyValue();
            $propertyValue = $this->convertToPlainValue($propertyValue);
        }

        if ($propertyValue !== NULL) {
            $checked = $propertyValue == $valueAttribute;
        }

        $this->registerFieldNameForFormTokenGeneration($nameAttribute);
        $this->tag->addAttribute('name', $nameAttribute);
        $this->tag->addAttribute('value', $valueAttribute);
        if ($checked === TRUE) {
            $this->tag->addAttribute('checked', 'checked');
        }

        $this->setErrorClassAttribute();

        return $this->tag->render();
    }
}