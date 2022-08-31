<?php
/**
* Plugin Name: Mewod Chat
* Description: Mewod Chat is a cool 3D metaverse chat built with WebGL technology, There are 12 free metaverse worlds available now, Mewod provides a new and interesting chat experience, You can also easily embed the chat into your iOS and Android apps with just a few lines of code.
* Version: 0.1
* Author: TOPCMM SOFTWARE
* Author URI: https://www.mewod.com/
**/

define('MEWOD_CHAT_VERSION', '1.0');

// register chat shortcode:
function mewod_chat_shortcode($atts = [], $content = null, $tag = '') {

	$current_user_id = get_current_user_id();
	$display_name = ($current_user_id == 0) ? 
		'guest'.random_int(100000, 999999) 
		: wp_get_current_user()->display_name;

	// normalize attribute keys, lowercase
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );
	
	// override default attributes with user attributes
	$chatw_atts = shortcode_atts(
		array(
			'width' => '1024',
			'height' => '768',
			'world' => '',
			'site' => 'demo',
		), $atts, $tag
	);
	$src = "https://app.mewod.com/";
	$src .=  $chatw_atts['world'] == '' ? 's/'. $chatw_atts['site'] : 'w/' . $chatw_atts['world'];
	$src .= "?init_user=" . $display_name;
	$html = "<iframe src=\"". $src 
			. "\" width=\"". $chatw_atts['width']. 
			"\" height=\"". $chatw_atts['height']
			. "\" frameborder=\"0\" allowfullscreen></iframe>";
    return $html;
}
add_shortcode('mewod-chat', 'mewod_chat_shortcode');