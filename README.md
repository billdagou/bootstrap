# TYPO3 Extension: Bootstrap

EXT:bootstrap allows you to use [Bootstrap](https://getbootstrap.com/) in your extensions.

**The extension version only matches the Bootstrap library version, it doesn't mean anything else.**

## How to use it
You can load the library in your Fluid template easily.

    <bs:css />
    <bs:js />

Or load it based on your needs.

    <bs:css build="..." rtl="..." />
    <bs:js build="..." />

You can also load your own libraries.

    <bs:css href="..." />
    <bs:js src="..." />

For more options please refer to &lt;f:asset.css&gt; and &lt;f:asset.script&gt;.

To use other Bootstrap source, you can register it in `ext_localconf.php` or `AdditionalConfiguration.php`.

    \Dagou\Bootstrap\Utility\ExtensionUtility::registerSource(\Dagou\Bootstrap\Source\JsDelivr::class);

You may want to disable the source and use the local one in some cases, for example saving page as PDF by [WKHtmlToPdf](https://wkhtmltopdf.org/).

    <bs:css disableSource="true" />
    <bs:js disableSource="true" />

##ViewHelper

####FlashMessages
- `queueIdentifier` (string) Flash-message queue to use.
- `severity` (string) Optional severity, must be either of one of [\TYPO3\CMS\Core\Messaging\AbstractMessage](https://github.com/TYPO3/typo3/blob/main/typo3/sysext/core/Classes/Messaging/AbstractMessage.php) constants.
- `flush` (boolean) Flush the message queue or no.

####Form/Validation
- `property` (string) Name of object property. **Required**
- `arguments` (array) Arguments for localization.
- `class` (string) CSS class(es) for this element. Default `invalid-feedback`.