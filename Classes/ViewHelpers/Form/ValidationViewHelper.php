<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use TYPO3\CMS\Extbase\Error\Result;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;
use TYPO3\CMS\Fluid\ViewHelpers\FormViewHelper;

class ValidationViewHelper extends AbstractFormFieldViewHelper {
    public function initializeArguments() {
        $this->registerArgument('name', 'string', 'Name of input tag');
        $this->registerArgument('property', 'string', 'Name of Object Property.');
        $this->registerArgument('arguments', 'array', 'Arguments', FALSE, []);
        $this->registerTagAttribute('class', 'string', 'CSS class(es) for this element', FALSE, 'invalid-feedback');
    }

    public function render() {
        if ($this->isObjectAccessorMode()) {
            $property = $this->viewHelperVariableContainer->get(FormViewHelper::class, 'formObjectName').'.'.$this->arguments['property'];

            $result = $this->getRequest()->getOriginalRequestMappingResults()->forProperty($property);
        } elseif ($this->arguments['name']) {
            $property = str_replace(['[', ']'], ['.', ''], $this->arguments['name']);

            $result = $this->getRequest()->getOriginalRequestMappingResults()->forProperty($property);
        } else {
            $result = new Result();
        }

        if ($result->hasErrors()) {
            $this->tag->setContent(
                LocalizationUtility::translate('validation.'.$property.'.'.$result->getErrors()[0]->getMessage(), $this->getRequest()->getControllerExtensionName(), $this->arguments['arguments'])
            );

            if ($this->tag->hasContent()) {
                $this->tag->addAttribute('class', $this->arguments['class']);

                return $this->tag->render();
            }
        }
    }
}