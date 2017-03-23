<?php
namespace Dagou\Bootstrap\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

class ImageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {
	/**
	 * @var string
	 */
	protected $tagName = 'img';

	/**
	 * @var array
	 */
	protected $shape = ['circle', 'rounded', 'thumbnail'];

	/**
	 * {@inheritDoc}
	 * @see \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper::initializeArguments()
	 */
	public function initializeArguments() {
		$this->registerArgument('alt', 'string', 'Alternative text.');
		$this->registerArgument('class', 'string', 'CSS class(es) for this element.');
		$this->registerArgument('responsive', 'boolean', 'Whether the image is responsive or not.');
		$this->registerArgument('shape', 'string', 'Image shape.');
		$this->registerArgument('src', 'string', 'Image file path.', TRUE);
	}

	/**
	 * @return string
	 */
	public function render() {
		$classes = [];

		if ($this->arguments['responsive']) {
			$classes[] = 'img-responsive';
		}
		if ($this->arguments['shape'] && in_array($this->arguments['shape'], $this->shape)) {
			$classes[] = 'img-'.$this->arguments['shape'];
		}
		if ($this->arguments['class']) {
			$classes[] = trim($this->arguments['class']);
		}

		if (count($classes)) {
			$this->tag->addAttribute('class', implode(' ', $classes));
		}

		$this->tag->addAttribute('src', PathUtility::stripPathSitePrefix(GeneralUtility::getFileAbsFileName($this->arguments['src'])));

		if ($this->arguments['alt']) {
			$this->tag->addAttribute('alt', $this->arguments['alt']);
		}

		return $this->tag->render();
	}
}