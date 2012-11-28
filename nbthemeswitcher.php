<?php
/*
Plugin Name: Netbiscuits Theme Switcher
Plugin URI: http://www.github.com/simonprickett/nbthemeswitcher/
Description: This plugin allows a Netbiscuits theme to be served to requests from NB
Author: Simon Prickett
Author URI: http://www.crudworks.org/
Version: 1.0
*/

/* 
Code adapted from IE6 detection and theme switching post by Nathan Rice:
http://www.nathanrice.net/blog/serve-ie6-visitors-the-default-wordpress-theme/
*/

add_filter('template', 'nbthemeswitcher');
add_filter('option_template', 'nbthemeswitcher');
add_filter('option_stylesheet', 'nbthemeswitcher');

function nbthemeswitcher($theme) {
	/* 
	Note for production use you will also need to check for your mobile site
	domain e.g. 'm.mydomain.com' as well as 'netbiscuits'
	*/
	if(strpos($_SERVER['HTTP_X_PROXY_HOST'], 'netbiscuits') !== false ||
	   strpos($_SERVER['HTTP_X_PROXY_HOST'], 'm.mydomain.com') !== false) {
	   	/* 
	   	This request came from Netbiscuits, does the device need a Tactile theme? 
	   	Note, this needs Netbiscuits support to enable HTTP_X_DEVICEPARAM_TACTILE_CANTACTILE
	   	for your custom application.
	   	*/
	   	if (strpos($_SERVER['HTTP_X_DEVICEPARAM_TACTILE_CANTACTILE'], 'true') !== false) {
	   		/* This device can use a Tactile theme. */
	   		$theme = 'twentyten';
	   	} else {
	   		/* This device needs a Classic BiscuitML theme. */
			$theme = 'twentyeleven';
		}
	}
	return $theme;
}
?>