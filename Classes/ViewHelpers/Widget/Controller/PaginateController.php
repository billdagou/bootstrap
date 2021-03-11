<?php
namespace Dagou\Bootstrap\ViewHelpers\Widget\Controller;

class PaginateController extends \TYPO3\CMS\Fluid\ViewHelpers\Widget\Controller\PaginateController {
    /**
     * @var array
     */
    protected $configuration = [
        'itemsPerPage' => 10,
        'insertAbove' => FALSE,
        'insertBelow' => TRUE,
        'maximumNumberOfLinks' => 5,
        'addQueryStringMethod' => 'GET',
        'section' => '',
        'pagination' => [
            'label' => 'Page navigation',
            'size' => '',
            'align' => '',
            'class' => '',
            'text' => [
                'first' => '&laquo;',
                'previous' => '&lsaquo;',
                'next' => '&rsaquo;',
                'last' => '&raquo;',
            ],
        ],
    ];

    public function initializeAction() {
        parent::initializeAction();

        if (!in_array($this->configuration['pagination']['size'], ['sm', 'lg'])) {
            $this->configuration['pagination']['size'] = '';
        }
        if (!in_array($this->configuration['pagination']['align'], ['start', 'center', 'end'])) {
            $this->configuration['pagination']['align'] = '';
        }
    }
}