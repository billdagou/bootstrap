<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use Dagou\Bootstrap\Traits\OverrideClassAttribute;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class TextareaViewHelper extends AbstractFormFieldViewHelper {
    use OverrideClassAttribute;

    /**
     * @var string
     */
    protected $tagName = 'textarea';

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this ViewHelper', FALSE, 'is-invalid');
        $this->registerArgument('required', 'bool', 'Specifies whether the textarea is required', FALSE, FALSE);
        $this->registerTagAttribute('autocomplete', 'string', 'Hint for form autofill feature');
        $this->registerTagAttribute('autofocus', 'string', 'Specifies that a text area should automatically get focus when the page loads');
        $this->registerTagAttribute('cols', 'int', 'The number of columns of a text area');
        $this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
        $this->registerTagAttribute('placeholder', 'string', 'The placeholder of the textarea');
        $this->registerTagAttribute('readonly', 'string', 'The readonly attribute of the textarea', FALSE);
        $this->registerTagAttribute('rows', 'int', 'The number of rows of a text area');

        $this->registerUniversalTagAttributes();

        $this->overrideClassAttribute('form-control');
    }

    /**
     * @return string
     */
    public function render(): string {
        $required = $this->arguments['required'];
        $name = $this->getName();
        $this->registerFieldNameForFormTokenGeneration($name);
        $this->setRespectSubmittedDataValue(TRUE);

        $this->tag->forceClosingTag(TRUE);
        $this->tag->addAttribute('name', $name);
        if ($required === TRUE) {
            $this->tag->addAttribute('required', 'required');
        }
        $this->tag->setContent(htmlspecialchars((string)$this->getValueAttribute()));
        $this->addAdditionalIdentityPropertiesIfNeeded();
        $this->setErrorClassAttribute();

        return $this->tag->render();
    }
}