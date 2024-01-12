<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class HiddenViewHelper extends AbstractFormFieldViewHelper {
    /**
     * @var string
     */
    protected $tagName = 'input';

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('respectSubmittedDataValue', 'bool', 'enable or disable the usage of the submitted values', FALSE, TRUE);

        $this->registerUniversalTagAttributes();
    }

    /**
     * @return string
     */
    public function render(): string {
        $name = $this->getName();
        $this->registerFieldNameForFormTokenGeneration($name);
        $this->setRespectSubmittedDataValue($this->arguments['respectSubmittedDataValue']);

        $this->tag->addAttribute('type', 'hidden');
        $this->tag->addAttribute('name', $name);
        $this->tag->addAttribute('value', $this->getValueAttribute());

        $this->addAdditionalIdentityPropertiesIfNeeded();

        return $this->tag->render();
    }
}