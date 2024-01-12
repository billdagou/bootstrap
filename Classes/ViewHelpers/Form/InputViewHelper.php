<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use Dagou\Bootstrap\Traits\OverrideClassAttribute;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

abstract class InputViewHelper extends AbstractFormFieldViewHelper {
    use OverrideClassAttribute;

    /**
     * @var string
     */
    protected $tagName = 'input';
    protected string $type = '';

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this ViewHelper', FALSE, 'is-invalid');
        $this->registerArgument('required', 'bool', 'If the field is required or not', FALSE, FALSE);
        $this->registerTagAttribute('autocomplete', 'string', 'Hint for form autofill feature');
        $this->registerTagAttribute('autofocus', 'string', 'Specifies that an input should automatically get focus when the page loads');
        $this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
        $this->registerTagAttribute('maxlength', 'int', 'The maxlength attribute of the input field (will not be validated)');
        $this->registerTagAttribute('readonly', 'string', 'The readonly attribute of the input field');
        $this->registerTagAttribute('size', 'int', 'The size of the input field');
        $this->registerTagAttribute('placeholder', 'string', 'The placeholder of the textfield');
        $this->registerTagAttribute('pattern', 'string', 'HTML5 validation pattern');

        $this->registerUniversalTagAttributes();

        $this->overrideClassAttribute('form-control');
    }

    /**
     * @return string
     */
    public function render(): string {
        $required = $this->arguments['required'];
        $type = $this->type;

        $name = $this->getName();
        $this->registerFieldNameForFormTokenGeneration($name);
        $this->setRespectSubmittedDataValue(true);

        $this->tag->addAttribute('type', $type);
        $this->tag->addAttribute('name', $name);

        $value = $this->getValueAttribute();

        if ($value !== NULL) {
            $this->tag->addAttribute('value', $value);
        }

        if ($required !== FALSE) {
            $this->tag->addAttribute('required', 'required');
        }

        $this->addAdditionalIdentityPropertiesIfNeeded();
        $this->setErrorClassAttribute();

        return $this->tag->render();
    }
}