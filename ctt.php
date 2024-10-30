<?php
/*
Plugin Name: Click To Tweet WordPress Plugin
Description: This plugin integrates with the Click To Tweet web app (located at clicktotweet.com) and allows you to insert Click To Tweet boxes in your blog posts.
Version: 2.0.14
Author: ClickToTweet.com
Author URI: http://ctt.ec/
Plugin URI: http://ctt.ec/
*/
if ( !defined( 'WPINC' ) ) {
	die;
}
function activate_plug_ctt() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/plugin-activation.php';
    ctt_activation::activate();
}
register_activation_hook( __FILE__, 'activate_plug_ctt' );

function call_ctt_class() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/ctt-class.php';
    require_once plugin_dir_path( __FILE__ ) . 'includes/ctt-shortcode.php';
    require_once plugin_dir_path( __FILE__ ) . 'includes/setting-action-ajax.php';
	$load_ajx = new ctt_load_ajax;
	$plugin = new CTTshortcode();
	return $plugin;
}
call_ctt_class();