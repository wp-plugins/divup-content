<?php
/*
Plugin Name: DivUp Content
Plugin URI: http://www.sebastianwebb.co.uk/wordpress-plugins.html
Description: Client friendly way to separate your WordPress post or page content into divs with (optional) custom CSS classes and ids. Adding the shortcode [divup] in between some content will split the content into 2 separate divs. You can enter as many [divup] shortcodes to a post or page as you like. Great for creating columns of content for magazine style websites while keeping shortcode markup to an absolute minimum. DivUp Content never uses inline styles, but it does automatically give divs fiendishly clever classes like first, last, div-1, div-2, div-3 and div-odd, div-even, mul-3, mul-4 (multiple of 1,2,3,4 etc). Adding 'multiple of' classes to divs is a unique feature of DivUp Content that makes grid layouts with multiple rows a breeze. For instance, the CSS for a 3 column layout (with 2 or more rows) in a 640px content area could be: .divup-wrap { overflow:hidden; } .divup { float:left;width:200px;margin-right:20px; } .mul-3 { margin-right:0; }. For a 6 Column layout, you would just change the CSS to .divup-wrap { overflow:hidden; } .divup { float:left;width:100px;margin-right:8px; } .mul-6 { margin-right:0; }. DivUp Content even has a CSS class solution to multi-row grid layouts with varying column widths. 
Version: 2.1
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

			// total matches
			var $matches;
			var $start_wrap_matches;
			var $end_wrap_matches;
			// wrapper count trackers
			var $total_wrap_count = 1;
			var $wrap_count=1;
			// div count trackers
			var $total_count = 2;
			var $div_count=2;
			var $diff_count=1;
			var $global_div_count=1;
			// store comma extracted values for post_processing
			var $first_div_strings = array();
			// store list of divs that are last in wrapper
			var $last_in_wrap = array();
			
			/**
			* PHP 4 Compatible Constructor
			*/
			function tvr_divup(){$this->__construct();}
			/**
			* PHP 5 Constructor
			*/       
			function __construct(){
				// add content filter and shortcode
				add_filter( 'the_content', array(&$this, 'check_divup'), 5);
				add_shortcode('divup', array(&$this, 'support_divup'));
				add_shortcode('startwrap', array(&$this, 'support_start_divwrap'));
				add_shortcode('endwrap', array(&$this, 'support_end_divwrap'));
				add_filter( 'the_content', array(&$this, 'post_shortcode_processing'), 150);
			} 
			
			// check for divup shortcodes
			function check_divup($content) {
				$subject = $content;
				$pattern = '/\[divup/';
				// if [divup]s exist, prepare auto classes for wrapper and first div
				if (preg_match_all($pattern, $subject, $matches)) {
					$this->matches = count($matches[0]);
					global $post; 
					
					// check for ids specified by user
					preg_match('/\[divup .*id=[\"|\']([^\"|\']+)[\"|\']/', 
					$content, 
					$out);
					if (strpos($out[1], ',') !== false) {
						$first_second_id = explode(',', $out[1]);
						$first_id_str = 'id="'.esc_attr(trim($first_second_id[0])).'" ';
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
						// check if div_count should be diffed
						if (strpos($first_class, 'diff') !== false) {
							$d_class = 'diff';
						}
						else {
							$d_class = 'div';
						}
						$first_class_str = ' class="divup '.$d_class.'-1 '.$d_class.'-odd first total-div-1 '.esc_attr
						($first_class).'"';
					}
					else {
						$first_class_str = ' class="divup div-1 div-odd first total-div-1 "';
					}

					// check for custom opening [divwrap] shortcodes
					if (preg_match_all('/\[startwrap/', $subject, $matches)) {
						$this->start_wrap_matches = count($matches[0]);
						// just return first div markup and content - user has manually added wrapper divs
						return $content;
					}
					// return the formatted content with auto wrapper div
					else {
						++$this->global_div_count;
						// return $content;
						return '<div id="divup-post-'.$post->ID.'" class="divup-wrap"><div '.$first_id_str.''.$first_class_str.'>' . $content . '</div></div>';
					}
				} 
				return $content;
			}

			// insert last and comma enabled classes
			function post_shortcode_processing($content) {
				if (!$this->start_wrap_matches) {
					return $content;
				}
				// add comma enabled ids/classes to first div in wrapper
				foreach($this->first_div_strings as $div_num => $array) {
					if ($array['id'] != '') {
						$content = str_replace('divup-id-'.$div_num.' ', esc_attr($array['id']), $content);
					}
					if ($array['class'] != '') {
						$content = str_replace('total-div-'.$div_num.' ', 'total-div-'.$div_num.' '.$array['class'], $content);
					}
				}
				// add last class
				foreach ($this->last_in_wrap as $div_num) {
					$content = str_replace('total-div-'.$div_num, 'last total-div-'.$div_num, $content);
				}
				return $content;
			}

			// replace [divwrap] shortcodes
			function support_end_divwrap() {
				// reset div counts
				$this->total_count = 2;
				$this->div_count=2;
				$this->diff_count=1;
				// store div number in global array
				$this->last_in_wrap[] = $this->global_div_count-1; // it gets incremented at end of function
				return '</div>
				</div>';
			}

			// replace [startwrap] shortcodes
			function support_start_divwrap($atts) {
				// possible attributes
				$id = '';
				$class = '';
				extract( shortcode_atts( array(
					'id' => '',
					'class' => '',
				), $atts ) );

				global $post;


				/*** resolve final CSS id and class strings ***/

				// check odd/even
				if ($this->is_odd($this->wrap_count)) {
					$odd_even = ' divup-wrap-odd';
				}
				else {
					$odd_even = ' divup-wrap-even';
				}

				// check multiple of
				$multiples = $this->get_multiples($this->wrap_count);

				// check if it's the last
				if ($this->total_wrap_count == ($this->start_wrap_matches)) {
					$last = ' divup-wrap-last';
				}
				else {
					$last = '';
				}

				// add user defined id if set
				if ($id != '') {
					$id_str = ' id="'.esc_attr($id).'"';
				} else {
					if ($this->wrap_count == 1) {
						$id_str = ' id="divup-post-'.$post->ID.'"';
					} else {
						$id_str = ' id="divup-post-'.$post->ID.'-'.$this->wrap_count.'"';
					}
				}

				$class_str = ' class="divup-wrap divup-wrap-'.$this->wrap_count.' '  . $odd_even . $multiples . $last;
				// add user defined class(s)
				if ($class != '') {
					$class_str.= ' '.esc_attr($class).'"'; // add user class
				}
				else {
					$class_str.= '"';
				}

				++$this->wrap_count;

				// return the div markup
				$wrap = "<div{$id_str}{$class_str}>
							<div id='divup-id-".$this->global_div_count."'
							class='divup div-1 div-odd first total-div-".$this->global_div_count." '>";
				++$this->total_wrap_count;
				++$this->global_div_count;
				return $wrap;
			}

			// replace [divup] shortcodes
			function support_divup($atts) { 
				// possible attributes
				$id = '';
				$class = '';
				extract( shortcode_atts( array(
					'id' => '',
					'class' => '',
				), $atts ) );

				/*** resolve final CSS id and class strings ***/
				
				// check if first div , (comma) functionality has been utilised
				if (strpos($id, ',') !== false) {
					$first_second_id = explode(',', $id);
					$id = trim($first_second_id[1]);
					// save first div in wrapper id for post-processing
					$this->first_div_strings[$this->global_div_count-1]['id'] = trim($first_second_id[0]);
				}
				if (strpos($class, ',') !== false) {
					$first_second_class = explode(',', $class);
					$class = trim($first_second_class[1]);
					// save first div in wrapper class for post-processing
					$this->first_div_strings[$this->global_div_count-1]['class'] = trim($first_second_class[0]);
					// if the diff class has been added to the first div reset count to 1, and increment $diff_count
					if (strpos($first_second_class[0], 'diff') !== false) {
						--$this->div_count;
						++$this->diff_count;
					}
				}

				// check odd/even
				if ($this->is_odd($this->div_count)) {
					$odd_even = ' div-odd';
				}
				else {
					$odd_even = ' div-even';
				}
				// diff odd/even
				if ($this->is_odd($this->diff_count)) {
					$diff_odd_even = ' diff-odd';
				}
				else {
					$diff_odd_even = ' diff-even';
				}
				
				// check what div is multiple of
				$multiples = $this->get_multiples($this->div_count);
				// diff multiple of
				$diff_multiples = $this->get_multiples($this->diff_count, 'diff');
				
				// check if it's the last div
				if ($this->total_count == ($this->matches+1)) {
					$last = ' last';
				}
				else {
					$last = '';
				}

				// add global div count
				$global_count = ' total-div-'.$this->global_div_count.' '; // space is need for post str_replace
				
				// add user defined id if set
				if ($id != '') {
					$id_str = ' id="'.esc_attr($id).'"';  // add user id
				} else {
					$id_str = ' id="divup-id-'.$this->global_div_count.'"';
				}
				// form the class attribute
				if (strpos($class, 'diff') !== false) { // if div_count should be diffped
					$class_str = ' class="divup diff-'.$this->diff_count.' ' . $diff_odd_even . $diff_multiples .
					$last . $global_count;
					++$this->diff_count;
				}
				else { // normal div
					$class_str = ' class="divup div-'.$this->div_count.' '  . $odd_even . $multiples .
					$last . $global_count;
					++$this->div_count;
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
				++$this->total_count;
				++$this->global_div_count;
				return $divup;
			}
			
			// check if odd
			function is_odd($number) {
			   return $number & 1; // 0 = even, 1 = odd
			}
			
			// check multiple
			function get_multiples($div_count, $type = 'div') {
				$number = 3; // odd and even replace mul-1, mul-2
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