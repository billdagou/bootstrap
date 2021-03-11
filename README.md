# TYPO3 Extension: Bootstrap

EXT:bootstrap allows you to use [Bootstrap](https://getbootstrap.com/) in your extensions.

**The extension version only matches the Bootstrap library version, it doesn't mean anything else.**

## How to use it
You can load the libraries in your Fluid template easily. You may need to load jQuery or even Popper.js manually.

    <bs:loadCss />
    <bs:loadJs />

You can also load your own libraries.

    <bs:loadCss href="..." />
    <bs:loadJs src="..." />

For more options please refer to &lt;f:asset.css&gt; and &lt;f:asset.script&gt;.

To use other Bootstrap source, you can register it in `ext_localconf.php` or `AdditionalConfiguration.php`.

    \Dagou\Bootstrap\Utility\ExtensionUtility::registerSource(\Dagou\Bootstrap\Source\JsDelivr::class);

You may want to disable the other source and use the local one instead in some cases, for example saving page as PDF by [WKHtmlToPdf](https://wkhtmltopdf.org/).

    <bs:loadCss disableSource="true" />
    <bs:loadJs disableSource="true" />