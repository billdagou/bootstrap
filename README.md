# TYPO3 Extension: Bootstrap
EXT:bootstrap allows you to use [Bootstrap](http://getbootstrap.com/) in your extensions.

**The extension version only matches the Bootstrap library version, it doesn't mean anything else.**

## How to use it
You can load the libraries in your Fluid template easily. You may need to load jQuery or even Popper.js manually.

    <bs:loadCss />
    <bs:loadJs />

You can also load your own libraries.

    <bs:loadCss css="..." />
    <bs:loadJs js="..." />
    
Or, load the javascript library on top.

    <bs:loadJs footer="false" />
    
To use the CDN resource, please set `$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN']` in `ext_localconf.php` or `AdditionalConfiguration.php`.

    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN'] = \Dagou\Bootstrap\CDN\StackPath::class;