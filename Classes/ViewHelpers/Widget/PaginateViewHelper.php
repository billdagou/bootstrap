<?php
namespace Dagou\Bootstrap\ViewHelpers\Widget;

use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetViewHelper;

class PaginateViewHelper extends AbstractWidgetViewHelper {
    /**
     * @var \Dagou\Bootstrap\ViewHelpers\Widget\Controller\PaginateController
     * @Inject
     */
    protected $controller;

    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('objects', 'mixed', 'Object', TRUE);
        $this->registerArgument('as', 'string', 'as', TRUE);
        $this->registerArgument('configuration', 'array', 'configuration', FALSE, []);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Mvc\ResponseInterface
     */
    public function render() {
        $objects = $this->arguments['objects'];

        if (!($objects instanceof QueryResultInterface || $objects instanceof ObjectStorage || is_array($objects))) {
            throw new \UnexpectedValueException('Supplied file object type '.get_class($objects).' must be QueryResultInterface or ObjectStorage or be an array.', 1574157684);
        }

        return $this->initiateSubRequest();
    }
}