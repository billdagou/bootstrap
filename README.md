# TYPO3 Extension: Bootstrap
EXT:bootstrap allows you to use [Bootstrap](http://getbootstrap.com/) in your extensions.

You can easily choose using CDN or local Bootstrap library.

**The extension version only matches Bootstrap library version, doesn't mean anything else.**

## How to use it
You can load the libraries in your Fluid template with **LoadCssViewHelper** and **LoadJsViewHelper**.
*Notice: you will need to load jQuery(or even Popper.js) manually if you are going to use the JS.*

	<html xmlns="http://www.w3.org/1999/xhtml" lang="en"
		xmlns:bs="http://typo3.org/ns/Dagou/Bootstrap/ViewHelpers">
		xmlns:jq="http://typo3.org/ns/Dagou/Jquery/ViewHelpers">
		<bs:loadCss />
		<jq:load />
		<bs:loadJs />
	</html>

You can also load your own libraries.

    <bs:loadCss css="..." />
    <bs:loadJs js="..." />
    
Or, load the JS before the &lt;BODY&gt; tag.

    <bs:loadJs footer="false" />
    
To add new CDN source, please refer to `\Dagou\Bootstrap\Cdn\Bootstrap` and update `$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['bootstrap']['CDN']` accordingly.  

## ViewHelper

#### [Alert](http://getbootstrap.com/docs/4.1/components/alerts/)

- `context` (string) Contextual class name, `primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark`. Default `primary`.
- `dismiss` (boolean) Allow dismissing or not.
- `animate` (boolean) Animated dismissing or not. Default `true`.
- `label` (string) ARIA label. Default `Close`.
- `symbol` (string) Dismissing symbol. Default `&times;`.

[Example](http://getbootstrap.com/docs/4.1/components/alerts/#examples)

	<bs:alert>A simple primary alert—check it out!</bs:alert>

[Link color](http://getbootstrap.com/docs/4.1/components/alerts/#link-color)

	<bs:alert>A simple primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.</bs:alert>

[Additional content](http://getbootstrap.com/docs/4.1/components/alerts/#additional-content)

	<bs:alert context="success">
	    <h4 class="alert-heading">Well done!</h4>
	    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
	    <hr>
	    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
    </bs:alert>

[Dismissing](http://getbootstrap.com/docs/4.1/components/alerts/#dismissing)

    <bs:alert context="warning" dismiss="true">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    </bs:alert>

#### [Badge](http://getbootstrap.com/docs/4.1/components/badge/)

- `context` (string) Contextual class name, `primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark`. Default `primary`.
- `pill` (boolean) Is pill badge or not.
- `link` (string) Link URL.

[Example](http://getbootstrap.com/docs/4.1/components/badge/#example)

    <h1>Example heading <bs:badge context="secondary">New</bs:badge></h1>
    
[Pill badge](http://getbootstrap.com/docs/4.1/components/badge/#pill-badges)

    <bs:badge context="primary" pill="true">Primary</bs:badge>
    
[Link](http://getbootstrap.com/docs/4.1/components/badge/#links)

    <bs:badge context="primary" link="#">Primary</bs:badge>

#### [Button](http://getbootstrap.com/docs/4.1/components/buttons/)

- `type` (string) Button type, `button`, `submit`, `reset`. Default `button`.
- `context` (string) Contextual class name, `primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark`. Default `primary`.
- `outline` (boolean) Is outline button or not.
- `size` (string) Button size, `lg`, `sm`.
- `block` (boolean) Block level button or not.
- `active` (boolean) Active or not.
- `disabled` (boolean) Disabled or not.
- `link` (string) Link URL.

[Examples](http://getbootstrap.com/docs/4.1/components/buttons/#examples)

    <bs:button>Primary</bs:button>

[Button tags](http://getbootstrap.com/docs/4.1/components/buttons/#button-tags)

    <bs:button link="#">Link</bs:button>

[Outline buttons](http://getbootstrap.com/docs/4.1/components/buttons/#outline-buttons)

    <bs:button outline="true">Primary</bs:button>

[Sizes](http://getbootstrap.com/docs/4.1/components/buttons/#sizes)

    <bs:button size="lg">Large button</bs:button>
    <bs:button size="sm">Small button</bs:button>
    <bs:button size="lg" block="true">Block level button</bs:button>

[Active state](http://getbootstrap.com/docs/4.1/components/buttons/#active-state)

    <bs:button size="lg" active="true" link="#">Primary link</bs:button>

[Disabled state](http://getbootstrap.com/docs/4.1/components/buttons/#disabled-state)

    <bs:button size="lg" disabled="true">Primary button</bs:button>
    <bs:button size="lg" disabled="true" link="#">Primary link</bs:button>

#### [Image](http://getbootstrap.com/docs/4.1/content/images/)

- `src` (string) Image path. **Requried**
- `responsive` (boolean) Is responsive image or not.
- `thumbnail` (boolean) Is thumbnail or not.
- `alt` (string) Alternative text.

[Responsive image](http://getbootstrap.com/docs/4.1/content/images/#responsive-images)

    <bs:image src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%221152%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201152%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16317183f9c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A58pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16317183f9c%22%3E%3Crect%20width%3D%221152%22%20height%3D%22250%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22408.98333740234375%22%20y%3D%22151.4%22%3E1152x250%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" responsive="true" />

[Image thumbnails](http://getbootstrap.com/docs/4.1/content/images/#image-thumbnails)

    <bs:image src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%221152%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201152%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16317183f9c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A58pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16317183f9c%22%3E%3Crect%20width%3D%221152%22%20height%3D%22250%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22408.98333740234375%22%20y%3D%22151.4%22%3E1152x250%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" thumbnail="true" />

#### [Progress](http://getbootstrap.com/docs/4.1/components/progress/)

- Progress
    - `height` (string) Progress height.
- Bar
    - `now` (int) Value now. **Required**.
    - `min` (int) Value min. Default `0`.
    - `max` (int) Value max. Default `100`.
    - `width` (string) Bar width.
    - `context` (string) Contextual class name, `primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark`. Default `primary`.
    - `stripe` (boolean) Striped bar or not.
    - `animate` (boolean) Animated striped bar or not.

[How it works](http://getbootstrap.com/docs/4.1/components/progress/#how-it-works)

    <bs:progress>
        <bs:progress.bar now="75" width="75%" />
    </bs:progress>

[Labels](http://getbootstrap.com/docs/4.1/components/progress/#labels)

    <bs:progress>
        <bs:progress.bar now="25" width="25%">25%</bs:progress.bar>
    </bs:progress>

[Height](http://getbootstrap.com/docs/4.1/components/progress/#height)

    <bs:progress height="1px">
        <bs:progress.bar now="25" width="25%" />
    </bs:progress>

[Backgrounds](http://getbootstrap.com/docs/4.1/components/progress/#backgrounds)

    <bs:progress>
        <bs:progress.bar now="25" width="25%" context="success" />
    </bs:progress>

[Multiple bars](http://getbootstrap.com/docs/4.1/components/progress/#multiple-bars)

    <bs:progress>
        <bs:progress.bar now="15" width="15%" />
        <bs:progress.bar now="30" width="30%" context="success" />
        <bs:progress.bar now="20" width="20%" context="info" />
    </bs:progress>

[Striped](http://getbootstrap.com/docs/4.1/components/progress/#striped)

    <bs:progress>
        <bs:progress.bar now="10" width="10%" stripe="true" />
    </bs:progress>

[Animated stripes](http://getbootstrap.com/docs/4.1/components/progress/#animated-stripes)

    <bs:progress>
        <bs:progress.bar now="75" width="75%" stripe="true" animate="true" />
    </bs:progress>