# TYPO3 Extension: Bootstrap
EXT:bootstrap allows you to use [Bootstrap](http://getbootstrap.com/) in your extensions.

You can easily choose using CDN or local Bootstrap library.

**The extension version only matches Bootstrap library version, doesn't mean anything else.**

## How to use it
You can load the library in your PHP code.

	\Dagou\Bootstrap\Utility\BootstrapUtility::loadBootstrap();

Or, use the ViewHelper in your Fluid template.

	<html xmlns="http://www.w3.org/1999/xhtml" lang="en"
		xmlns:bs="http://typo3.org/ns/Dagou/Bootstrap/ViewHelpers">
		<bs:load />
	</html>

#### AlertViewHelper
The ViewHelper to render the Alerts component via a flash-message queue.

	<bs:alert />

Allowed attributes:

- `identifier` (string)
Flash-message queue identifier.

#### ImageViewHelper
The ViewHelper to render a responsive image.

	<bs:image src="..." />

Allowed attributes:

- `src` (string)
Image file path, **required**.

- `alt` (string)
Alternative text.

- `responsive` (boolean)
Whether the image is responsive or not.

- `class` (string)
Other class(es) you need for the image.

- `shape` (string)
Image shape. Allowed value: `rounded`, `circle`, `thumbnail`.

#### LoadViewHelper
The ViewHelper you need to load Bootstrap library in your Fluid template.

	<bs:load />

Allowed attributes:

- `css` (string)
Customized Bootstrap library.

- `js` (string)
Customized Bootstrap javascript library.

- `footer` (boolean)
Add the library to footer or not. Default: `TRUE`.

- `enableTheme` (boolean)
Use Bootstrap theme or not.

- `theme` (string)
Customized Bootstrap theme.

## How to maintain the CDN resources
To replace or add new CDN resources, please update $GLOBALS\['TYPO3\_CONF\_VARS'\]\['EXTCONF'\]\['bootstrap'\]\['CDN'\] in your own extension.

	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN']['New_CDN_Name'] = [
		'css' => '...',
		'js' => '...',
		'theme' => '...',
	];