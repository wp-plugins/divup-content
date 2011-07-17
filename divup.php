<?php
/*
Plugin Name: DivUp Content
Plugin URI: http://www.sebastianwebb.co.uk/wordpress-plugins.html
Description: Client friendly way to separate your WordPress post or page content into divs with (optional) custom CSS classes and ids. Adding the shortcode [divup] in between some content will split the content into 2 separate divs. You can enter as many [divup] shortcodes to a post or page as you like. Great for creating columns of content for magazine style websites while keeping shortcode markup to an absolute minimum. DivUp Content never uses inline styles, but it does automatically give divs fiendishly clever classes like first, last, div-1, div-2, div-3 and div-odd, div-even, mul-3, mul-4 (multiple of 1,2,3,4 etc). Adding 'multiple of' classes to divs is a unique feature of DivUp Content that makes grid layouts with multiple rows a breeze. For instance, the CSS for a 3 column layout (with 2 or more rows) in a 640px content area could be: .divup-wrap { overflow:hidden; } .divup { float:left;width:200px;margin-right:20px; } .mul-3 { margin-right:0; }. For a 6 Column layout, you would just change the CSS to .divup-wrap { overflow:hidden; } .divup { float:left;width:100px;margin-right:8px; } .mul-6 { margin-right:0; }. DivUp Content even has a CSS class solution to multi-row grid layouts with varying column widths. 
Version: 1.0
Author: Sebastian Web Design
Author URI: http://www.sebastianwebb.co.uk

Copyright 2011 Sebastian Webb

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

// Stop direct call
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { 
	die('Please do not call this page directly.'); 
}

// only run DivUp Content on frontend
if (!is_admin()) {
	// admin class
	if (!class_exists('tvr_divup')) {		
		// define
		class tvr_divup {
			
			var $matches;
			
			/**
			* PHP 4 Compatible Constructor
			*/
			function tvr_divup(){$this->__construct();}
			/**
			* PHP 5 Constructor
			*/       
			function __construct(){
				// add content filter and shortcode
				add_filter( 'the_content', array(&$this, 'check_divup'));
				add_shortcode('divup', array(&$this, 'support_divup'));
			} 
			
			// check for divup shortcodes
			function check_divup($content) {
				$subject = $content;
				$pattern = '/\[divup/';
				// if [divup]s exist, create shortcode function
				if (preg_match_all($pattern, $subject, $matches)) {
					$this->matches = count($matches[0]);
					global $post; 
					
					// check for ids specified by user
					preg_match('/\[divup .*id=[\"|\']([^\"|\']+)[\"|\']/', 
					$content, 
					$out);
					if (strpos($out[1], ',') !== false) {
						$first_second_id = explode(',', $out[1]);
						$first_id_str = 'id="'.trim($first_second_id[0]).'" '; 
					}
					else {
						$first_id_str = '';
					}
					// check for classes specified by user
					preg_match('/\[divup .*class=[\"|\']([^\"|\']+)[\"|\']/', 
					$content, 
					$out);
					if (strpos($out[1], ',') !== false) {
						$first_second_class = explode(',', $out[1]);
						$first_class = ' ' . trim($first_second_class[0]); 
						// check if div_count should be diffped
						if (strpos($first_class, 'diff') !== false) { 
							$first_class_str = ' class="divup diff-1 diff-odd first '.esc_attr($first_class).'"';
						}
						else {
							$first_class_str = ' class="divup div-1 div-odd first '.esc_attr($first_class).'"';
						}
					}
					else {
						$first_class_str = ' class="divup div-1 div-odd first"';
					}
					
					// return the formatted content
					return '<!-- begin divups -->
					<div id="divup-post-'.$post->ID.'" class="divup-wrap">
					<div '.$first_id_str.''.$first_class_str.'>
					' . $content . '
					</div>
					</div>
					<!-- end divup-wrap -->';
				} 
				return $content;
			}
			
			// replace [divup] shortcodes
			function support_divup($atts) { 
				// possible attributes
				extract( shortcode_atts( array(
					'id' => '',
					'class' => '',
				), $atts ) );
				
				static $total_count = 2;
				static $div_count=2;
				static $diff_count=1;
				
				
				/*** resolve final CSS id and class strings ***/
				
				// check if first div , functionality has been utilised
				if (strpos($id, ',') !== false) {
					$first_second_id = explode(',', $id);
					$id = trim($first_second_id[1]);
				}
				if (strpos($class, ',') !== false) {
					$first_second_class = explode(',', $class);
					$class = trim($first_second_class[1]);
					// if the diff class has been added to the first div reset count to 1, and increment $diff_count
					if (strpos($first_second_class[0], 'diff') !== false) {
						--$div_count;
						++$diff_count;
					}
				}
				
				// check odd/even
				if ($this->is_odd($div_count)) {
					$odd_even = ' div-odd';
				}
				else {
					$odd_even = ' div-even';
				}
				// diff odd/even
				if ($this->is_odd($diff_count)) {
					$diff_odd_even = ' diff-odd';
				}
				else {
					$diff_odd_even = ' diff-even';
				}
				
				// check what div is multiple of
				$multiples = $this->get_multiples($div_count);
				// diff mulitple of
				$diff_multiples = $this->get_multiples($diff_count, 'diff');
				
				// check if it's the last div
				if ($total_count == ($this->matches+1)) {
					$last = ' last';
				}
				else {
					$last = '';
				}
				// diff last - better if total div count on diff div too
				
				// add user defined id if set
				if ($id != '') {
					$id_str = ' id="'.esc_attr($id).'"';  // add user id
				}
				// form the class attribute
				if (strpos($class, 'diff') !== false) { // if div_count should be diffped
					$class_str = ' class="divup diff-'.$diff_count.' ' . $diff_odd_even . $diff_multiples . $last;
					$diff_count++;
				}
				else { // normal div
					$class_str = ' class="divup div-'.$div_count.' '  . $odd_even . $multiples . $last;
					$div_count++;
				}
				// add user defined class(s)
				if ($class != '') {
					$class_str.= ' '.esc_attr($class).'"'; // add user class
				}
				else {
					$class_str.= '"';
				}

				// return the div markup
				$divup = "
				</div>
				<div{$id_str}{$class_str}>
				";
				++$total_count;
				return $divup;
			}
			
			// check if odd
			function is_odd($number) {
			   return $number & 1; // 0 = even, 1 = odd
			}
			
			// check multiple
			function get_multiples($div_count, $type='div') {
				$number = 3;
				$multiple = '';
				if ($type == 'div') {
					$mul = 'mul';
				}
				else {
					$mul = 'diff-mul';
				}
				while ($number <= $div_count) {
					
					if ($div_count % $number == 0) {
						$multiple.= ' '.$mul.'-'.$number;
					} 
					++$number;
				}
				return $multiple;
			}
			
		} // end class
	} // end 'if(!class_exists)'
	
	// instantiate the frontend class
	if (class_exists('tvr_divup')) {
		$tvr_divup_var = new tvr_divup();
	}
	
} // end if !is_admin()

?>