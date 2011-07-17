=== DivUp Content ===

Contributors: bastywebb
Donate link: http://www.sebastianwebb.co.uk/wordpress-plugins.html
Tags: content, columns, column, columnise, column layout, multiple columns, grid, layout, magazine, page, posts, magazine columns, magazine style, magazine layout, float, div, separate, separation, div up, split
Requires at least: 2.8
Tested up to: 3.2.1
Stable tag: 1.0

Flexible & elegant way to split post/page content into divs. Divs are given ordinal classes (div-1, div-2 etc). Minimal shortcode. Client Friendly

== Description ==

Client friendly way to separate your WordPress post or page content into divs with (optional) custom CSS classes and ids. Adding the shortcode [divup] in between some content will split the content into 2 separate divs. 

You can enter as many [divup] shortcodes to a post or page as you like. Great for creating columns of content for magazine style websites while keeping shortcode markup to an absolute minimum. DivUp Content never uses inline styles, but it does automatically give divs fiendishly clever classes like first, last, div-1, div-2, div-3, and div-odd, div-even, mul-3, mul-4 (multiple of 3,4 etc). 

Adding 'multiple of' classes to divs is a unique feature of DivUp Content that makes grid layouts with multiple rows a breeze. 

= Example CSS =

The CSS for a 3 column layout (with 2 or more rows) in a 640px content area could be: 

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

For a 6 Column layout, you would just change the CSS to:

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

DivUp Content even has a CSS class solution to multi-row grid layouts with varying column widths.

For usage and more info, visit <a title="DivUp Content Docs"  href="http://www.sebastianwebb.co.uk/wordpress-plugins.html" target="_blank">sebastianwebb.co.uk/wordpress-plugins.html</a>.

== Installation ==

1. Upload `divup` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the [divup] shortcode in your posts or pages:
   
The best way to understand how DivUp Content works (including the advanced aspects) is to copy and paste the following content into a post or page and then inspect the html with firebug - paying attention to the CSS classes it automatically applies to the divs.

= Dummy Content: =
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
Yes. Just send an email, and I'd be happy to help

= Where can I find documentation? =
<a title="DivUp Content Docs"  href="http://www.sebastianwebb.co.uk/wordpress-plugins.html" target="_blank">Visit DivUp Content Info Page</a>.

== Screenshots ==

This is an example of how you could use the [divup] shorcode in your markup:

wysiwyg-divup-screenshot.gif

Given the markup above, this is how it would wrap your content in divs with automatic and custom classes and ids (firebug screenshot):

firebug-divup-screenshot.gif

You could then create a number of different column layouts by only changing the CSS (note: the custom classes and ids aren't necessary for creating the following grid layouts, they're just there to show you that you can add custom classes and ids if you want to).

= 4 columns in one row =

4x1.gif

/* 4x1 */
.divup-wrap { 
	overflow:hidden; 
} 
.divup { 
	float:left;
	width:145px;
	margin-right:20px; 
} 
.mul-4 { 
	margin-right:0; 
}

= 2 columns, 2 rows =

2x2.gif

/* 2x2 */
.divup-wrap { 
	overflow:hidden; 
} 
.divup { 
	float:left;
	width:310px;
	margin-right:20px;
	margin-bottom:20px; 
} 
.div-even { 
	margin-right:0; 
}

= 3 columns, top row is full width =

3x2-wide-top.gif

/* 3x2 (top column full width) */
.divup-wrap { 
	overflow:hidden; 
} 
.divup { 
	float:left;
	width:200px;
	margin-right:20px;
	margin-bottom:20px; 
} 
.div-1 { 
	width:640px; 
}
.div-1, div-4 { 
	margin-right:0; 
}

For more advanced layouts, the 'diff' class has got you covered. More information on <a title="DivUp Content Docs"  href="http://www.sebastianwebb.co.uk/wordpress-plugins.html" target="_blank">the plugin docs page</a>.