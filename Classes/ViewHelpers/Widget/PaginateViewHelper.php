<?php
namespace Dagou\Bootstrap\ViewHelpers\Widget;

use TYPO3\CMS\Extbase\Annotation\Inject;

class PaginateViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Widget\PaginateViewHelper {
    /**
     * @var \Dagou\Bootstrap\ViewHelpers\Widget\Controller\PaginateController
     * @Inject()
     */
    protected $controller;
}