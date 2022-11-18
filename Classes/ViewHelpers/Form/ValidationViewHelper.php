<?php
namespace Dagou\Bootstrap\ViewHelpers\Form;

use TYPO3\CMS\Extbase\Error\Result;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;
use TYPO3\CMS\Fluid\ViewHelpers\FormViewHelper;

class ValidationViewHelper extends AbstractFormFieldViewHelper {
    public function initializeArguments() {
        $this->registerArgument('property', 'string', 'Name of object property', TRUE);
        $this->registerArgument('arguments', 'array', 'Arguments for localization');
        $this->registerTagAttribute('class', 'string', 'CSS class(es) for this element', FALSE, 'invalid-feedback');
    }

    /**
     * @return string
     */
    public function render(): string {
        $formObjectName = $this->viewHelperVariableContainer->get(FormViewHelper::class, 'formObjectName');

        $result = $this->isObjectAccessorMode() ?
            $this->getRequest()
                ->getOriginalRequestMappingResults()
                    ->forProperty($formObjectName)
                        ->forProperty($this->arguments['property'])
            :
            new Result();

        if ($result->hasErrors()) {
            $error = $result->getErrors()[0]->getMessage();

            $this->tag->setContent(
                LocalizationUtility::translate(
                    'validation.'.$formObjectName.'.'.$this->arguments['property'].'.'.$error,
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