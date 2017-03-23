<?php
namespace Dagou\Bootstrap\ViewHelpers;

use Dagou\Bootstrap\Utility\BootstrapUtility;

class LoadViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	 * {@inheritDoc}
	 * @see \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper::initializeArguments()
	 */
	public function initializeArguments() {
		$this->registerArgument('css', 'string', 'Customized Bootstrap stylesheet.');
		$this->registerArgument('enableTheme', 'boolean', 'Use Bootstrap theme or not.');
		$this->registerArgument('footer', 'boolean', 'Add to footer or not.', FALSE, TRUE);
		$this->registerArgument('js', 'string', 'Customized Bootstrap javascript.');
		$this->registerArgument('theme', 'string', 'Customized Bootstrap theme.');
	}

	/**
	 * @return void
	 */
	public function render() {
		BootstrapUtility::loadBootstrap($this->arguments['js'], $this->arguments['css'], $this->arguments['footer']);

		if ($this->arguments['enableTheme']) {
			BootstrapUtility::loadBootstrapTheme($this->arguments['theme']);
		}
	}
}