<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;
use TYPO3\CMS\Fluid\ViewHelpers\FormViewHelper;

class ValidationViewHelper extends AbstractFormFieldViewHelper {
    public function initializeArguments(): void {
        $this->registerArgument('property', 'string', 'Name of object property');
        $this->registerArgument('name', 'string', 'Name of input tag');
        $this->registerArgument('arguments', 'array', 'Arguments for localization');
        $this->registerTagAttribute('class', 'string', 'CSS class(es) for this element', FALSE, 'invalid-feedback');
    }

    /**
     * @return string
     */
    public function render(): string {
        if ($this->isObjectAccessorMode()) {
            $property = $this->viewHelperVariableContainer->get(FormViewHelper::class, 'formObjectName') . '.' . $this->arguments['property'];
        } else {
            $property = rtrim(preg_replace('/(\\]\\[|\\[|\\])/', '.', $this->arguments['name'] ?? '') ?? '', '.');
        }

        /** @var \TYPO3\CMS\Extbase\Error\Result $result */
        $result = $this->getRequest()->getAttribute('extbase')->getOriginalRequestMappingResults();

        if ($property !== '') {
            $result = $result->forProperty($property);
        }

        if ($result->hasErrors()) {
            $error = $result->getErrors()[0]->getMessage();

            $this->tag->setContent(
                LocalizationUtility::translate(
                    'validation'.($property ? '.'.$property : '').'.'.$error,
                    $this->getRequest()->getControllerExtensionName(),
                    $this->arguments['arguments']
                ) ?? $error
            );

            $this->tag->addAttribute('class', $this->arguments['class']);

            return $this->tag->render();
        }

        return '';
    }
}