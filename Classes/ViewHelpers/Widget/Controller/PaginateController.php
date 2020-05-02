<?php
namespace Dagou\Bootstrap\ViewHelpers\Widget\Controller;

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetController;

class PaginateController extends AbstractWidgetController {
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
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|\TYPO3\CMS\Extbase\Persistence\ObjectStorage|array
     */
    protected $objects;
    /**
     * @var int
     */
    protected $currentPage;
    /**
     * @var int
     */
    protected $numberOfPages;

    public function initializeAction() {
        $this->objects = $this->widgetConfiguration['objects'];

        ArrayUtility::mergeRecursiveWithOverrule($this->configuration, $this->widgetConfiguration['configuration'], FALSE);
        if (!in_array($this->configuration['pagination']['size'], ['sm', 'lg'])) {
            $this->configuration['pagination']['size'] = '';
        }
        if (!in_array($this->configuration['pagination']['align'], ['start', 'center', 'end'])) {
            $this->configuration['pagination']['align'] = '';
        }

        $this->numberOfPages = ceil(count($this->objects) / $this->configuration['itemsPerPage']);
    }

    /**
     * @param int $page
     */
    public function indexAction(int $page = 1) {
        $this->currentPage = $page;

        if ($this->currentPage < 1) {
            $this->currentPage = 1;
        }
        if ($this->currentPage > $this->numberOfPages) {
            $this->currentPage = $this->numberOfPages;
        }
        if ($this->currentPage === 0) {
            return FALSE;
        }

        $this->view->assignMultiple([
            'contentArguments' => [
                $this->widgetConfiguration['as'] => $this->prepareObjectsSlice(
                    $this->configuration['itemsPerPage'],
                    ($this->currentPage - 1) * $this->configuration['itemsPerPage']
                        + ($this->object instanceof QueryResultInterface ? $this->objects->getQuery()->getOffset() : 0)
                ),
            ],
            'configuration' => $this->configuration,
            'pagination' => $this->buildPagination(),
        ]);
    }

    /**
     * @param int $itemsPerPage
     * @param int $offset
     *
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     */
    protected function prepareObjectsSlice(int $itemsPerPage, int $offset) {
        if ($this->objects instanceof QueryResultInterface) {
            $query = $this->objects->getQuery();

            if ($offset > 0) {
                $query->setOffset($offset);
            }

            $currentRange = $offset + $itemsPerPage;
            $endOfRange = min($currentRange, count($this->objects));

            return $query->setLimit($currentRange < $endOfRange ? $itemsPerPage : $endOfRange - $offset)
                ->execute();
        }

        return array_slice($this->objects instanceof ObjectStorage ? $this->objects->toArray() : $this->objects, $offset, $itemsPerPage);
    }

    protected function buildPagination(): array {
        $maximumNumberOfLinks = $this->configuration['maximumNumberOfLinks'];

        if ($maximumNumberOfLinks > $this->numberOfPages) {
            $maximumNumberOfLinks = $this->numberOfPages;
        }

        $delta = floor($maximumNumberOfLinks / 2);
        $start = $this->currentPage - $delta;

        if ($this->currentPage + $maximumNumberOfLinks - $delta > $this->numberOfPages) {
            $start = $this->numberOfPages - $maximumNumberOfLinks + 1;
        }

        if ($start < 1) {
            $start = 1;
        }

        $end = $start + $maximumNumberOfLinks - 1;

        return [
            'pages' => range($start, $end),
            'current' => $this->currentPage,
            'numberOfPages' => $this->numberOfPages,
        ];
    }
}