=== DivUp Content ===

Contributors: bastywebb
Donate link: http://www.sebastianwebb.co.uk/wordpress-plugins.html
Tags: content, columns, column, columnise, column layout, multiple columns, grid, layout, magazine, page, posts, magazine columns, magazine style, magazine layout, float, div, separate, separation, div up, split
Requires at least: 2.8
Tested up to: 3.5.1
Stable tag: 2.0

Flexible & elegant way to split post/page content into divs. Divs are given ordinal classes (div-1, div-2 etc). Minimal shortcode. Client Friendly

== Description ==

Client friendly way to separate your WordPress post or page content into divs with (optional) **custom CSS classes and ids**. Adding the shortcode **[divup]** in between some content will split the content into 2 **separate divs**. 

You can enter as many [divup] shortcodes to a post or page as you like. Great for creating **columns** of content for magazine style websites while keeping shortcode markup to an absolute minimum. DivUp Content never uses inline styles, but it does automatically give divs fiendishly clever classes like first, last, div-1, div-2, div-3, and div-odd, div-even, mul-3, mul-4 (multiple of 1,2,3,4 etc). You can then create your own style rules for the divs in style.css 

Adding 'multiple of' classes to divs is a unique feature of DivUp Content that makes **grid layouts with multiple rows** a breeze.

**NEW: You can also add multiple [startwrap] and [endwrap] shortcodes to control how the divs are wrapped in a wrapper div. This overrides the original auto-wrapper functionality if you choose to use it.**

= 3 Column Example CSS =

The CSS for a **3 column layout** (with 2 or more rows) in a 640px content area could be: 

.divup-wrap { 
	overflow:hidden; 
} 
.divup { 
	float:left;
	width:200px;
	margin-right:20px; 
} 
.mul-3 { 
	margin-right:0; 
}

= 6 Column Example CSS =
For a **6 column layout**, you would just change the CSS to:

.divup-wrap { 
	overflow:hidden; 
} 
.divup { 
	float:left;
	width:100px;
	margin-right:8px; 
} 
.mul-6 { 
	margin-right:0; 
}. 

= Advanced Layouts =
DivUp Content even has a CSS class solution to **multi-row grid layouts with varying column widths**. There is no type of layout for which it would be unsuitable. **But a knowledge of CSS is required**.

For usage and more info, visit <a title="DivUp Content Docs"  href="http://www.sebastianwebb.co.uk/wordpress-plugins.html" target="_blank">sebastianwebb.co.uk/wordpress-plugins.html</a>.

== Installation ==

1. Upload `divup` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the [divup] shortcode in your posts or pages:
   
The best way to understand how DivUp Content works (including the advanced aspects) is to **copy and paste the ONE of the following dummy content examples below into a post or page and then inspect the html with firebug** - paying attention to the CSS classes it automatically applies to the divs.

= Dummy Content 1 - The New Way (Add as many [startwrap] and [endwrap] shortcodes as you like) =
**With verison 2.0, you can now control when the wrapper div that wraps all the divup divs starts and ends. You can also separate the divs into multiple wrapper divs. The automatic ordinal classes will start from 1 again for each wrapper (although there is also a gloabl count of all the divs on the page). Use the new [startwrap] shortcode to begin your wrapper and the new [endwrap] shortcode to end your wrapper. Remember that every [startwrap] shortcode requires an accompanying [endwrap] else you are likely to break the layout of your page. The startwrap and endwrap shortcodes are optional, if you don't use them DivUp Content will still function as it always has.**

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[startwrap class="my-wrap-class another-wrap-class"]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup id='id-a, id-b' class='class-a, class-b class-b2']

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[endwrap]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[startwrap id="my-wrap-id" class="hello-wrap"]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup class='my-class diff ']

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup id='my-id' class='diff my-class2']

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup class='diff']

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[endwrap]



= Dummy Content 2 - The Original Way (let DivUp Content add one wrapper div) =
Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup id='id-a, id-b' class='class-a, class-b class-b2']

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup class='my-class diff ']

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup id='my-id' class='diff my-class2']

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup class='diff']

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page.

[divup]

Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. Some content on this page. 

For usage and more info, visit <a title="DivUp Content Docs"  href="http://www.sebastianwebb.co.uk/wordpress-plugins.html" target="_blank">sebastianwebb.co.uk/wordpress-plugins.html</a>.

== Frequently Asked Questions ==

= Is This Plugin Supported? =
Yes. Just send an email, and I'd be happy to help. Or, if you think the answer to your question might benefit others, please post your question in the <a href="http://wordpress.org/tags/divup-content?forum_id=10">DivUp Content Forum</a> (which I actively monitor).  

= Where can I find documentation? =
<a title="DivUp Content Docs"  href="http://www.sebastianwebb.co.uk/wordpress-plugins.html" target="_blank">Visit DivUp Content Info Page</a>.

== Screenshots ==
1. This is an example of how you could use the [divup] shorcode in your markup (note: the custom classes and ids aren't necessary for creating the following grid layouts, they're just there to show you that you can add custom classes and ids if you want to).
2. Given the markup example above, this is how DivUp Content would wrap your content in divs with automatic and custom classes and ids (firebug screenshot)
3. 4x1 grid CSS (assuming a 640px content area): .divup-wrap { overflow:hidden; } .divup { float:left;width:145px;margin-right:20px; } .mul-4 { margin-right:0; }
4. 2x2 grid (assuming a 640px content area): .divup-wrap { overflow:hidden; } .divup { float:left;width:310px;margin-right:20px;margin-bottom:20px; } 
.div-even { margin-right:0; }
5. 3x2 grid (assuming a 640px content area):.divup-wrap { overflow:hidden; } .divup { float:left;width:200px;margin-right:20px;margin-bottom:20px; } .div-1{ width:640px; }.div-1, div-4 { margin-right:0; }. For more advanced layouts, the special 'diff' CSS class has you covered. View the <a title="DivUp Content Docs" href="http://www.sebastianwebb.co.uk/wordpress-plugins.html" target="_blank">DivUp Content docs</a> for more info.

== Changelog == 

With verison 2.0, you can now control when the wrapper div that wraps all the divup divs starts and ends. You can also separate the divs into multiple wrapper divs. The automatic ordinal classes will start from 1 again for each wrapper (although there is also a gloabl count of all the divs on the page). Use the new [startwrap] shortcode to begin your wrapper and the new [endwrap] shortcode to end your wrapper. Remember that every [startwrap] shortcode requires an accompanying [endwrap] else you are likely to break the layout of your page. The new [startwrap] and [endwrap] shortcodes are optional, if you don't use them DivUp Content will still function as it always has.
