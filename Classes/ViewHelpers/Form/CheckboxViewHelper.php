<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use Dagou\Bootstrap\Traits\OverrideClassAttribute;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class CheckboxViewHelper extends AbstractFormFieldViewHelper {
    use OverrideClassAttribute;

    /**
     * @var string
     */
    protected $tagName = 'input';

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('checked', 'bool', 'Specifies that the input element should be preselected');
        $this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this ViewHelper', FALSE, 'is-invalid');
        $this->registerArgument('multiple', 'bool', 'Specifies whether this checkbox belongs to a multivalue (is part of a checkbox group)', FALSE, FALSE);
        $this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
        $this->registerTagAttribute('role', 'string', '');

        $this->registerUniversalTagAttributes();

        $this->overrideArgument('value', 'string', 'Value of input tag. Required for checkboxes', TRUE);
        $this->overrideClassAttribute('form-check-input');
    }

    /**
     * @return string
     */
    public function render(): string {
        $checked = $this->arguments['checked'];
        $multiple = $this->arguments['multiple'];

        $this->tag->addAttribute('type', 'checkbox');

        $nameAttribute = $this->getName();
        $valueAttribute = $this->getValueAttribute();
        $propertyValue = NULL;
        if ($this->hasMappingErrorOccurred()) {
            $propertyValue = $this->getLastSubmittedFormData();
        }
        if ($checked === NULL && $propertyValue === NULL) {
            $propertyValue = $this->getPropertyValue();
        }

        if ($propertyValue instanceof \Traversable) {
            $propertyValue = iterator_to_array($propertyValue);
        }

        if (is_array($propertyValue)) {
            $propertyValue = array_map($this->convertToPlainValue(...), $propertyValue);

            if ($checked === NULL) {
                $checked = in_array($valueAttribute, $propertyValue);
            }

            $nameAttribute .= '[]';
        } elseif ($multiple === TRUE) {
            $nameAttribute .= '[]';
        } elseif ($propertyValue !== NULL) {
            $checked = (bool)$propertyValue === (bool)$valueAttribute;
        }

        $this->registerFieldNameForFormTokenGeneration($nameAttribute);
        $this->tag->addAttribute('name', $nameAttribute);
        $this->tag->addAttribute('value', $valueAttribute);
        if ($checked === TRUE) {
            $this->tag->addAttribute('checked', 'checked');
        }

        $this->setErrorClassAttribute();
        $hiddenField = $this->renderHiddenFieldForEmptyValue();
        return $hiddenField.$this->tag->render();
    }
}