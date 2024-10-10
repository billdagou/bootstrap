<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use Dagou\Bootstrap\Traits\OverrideClassAttribute;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class UploadViewHelper extends AbstractFormFieldViewHelper {
    use OverrideClassAttribute;

    /**
     * @var string
     */
    protected $tagName = 'input';

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this ViewHelper', FALSE, 'is-invalid');
        $this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
        $this->registerTagAttribute('multiple', 'string', 'Specifies that the file input element should allow multiple selection of files');
        $this->registerTagAttribute('accept', 'string', 'Specifies the allowed file extensions to upload via comma-separated list, example ".png,.gif"');

        $this->registerUniversalTagAttributes();

        $this->overrideClassAttribute('form-control');
    }

    /**
     * @return string
     */
    public function render(): string {
        $name = $this->getName();
        $allowedFields = ['name', 'type', 'tmp_name', 'error', 'size'];
        foreach ($allowedFields as $fieldName) {
            $this->registerFieldNameForFormTokenGeneration($name . '[' . $fieldName . ']');
        }
        $this->tag->addAttribute('type', 'file');

        if (isset($this->arguments['multiple'])) {
            $this->tag->addAttribute('name', $name . '[]');
        } else {
            $this->tag->addAttribute('name', $name);
        }

        $this->setErrorClassAttribute();
        return $this->tag->render();
    }
}