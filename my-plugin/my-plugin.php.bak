<?php
	/*
		Plugin Name: My Plugin
	*/


/**
 * To enqueue scripts and styles
 */
function add_ews_service_stylesheet() {
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'my-theme-ie', $plugin_url .'assets/bootstrap.css'  );
	wp_enqueue_style( 'my-theme-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'  );
    wp_enqueue_script( 'script-name', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'script-name2', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'script-name3', $plugin_url .'assets/ews-service.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'add_ews_service_stylesheet' );




include_once dirname( __FILE__ ) . '/admin/options.php';
include_once dirname( __FILE__ ) . '/admin/class-my-plugin.php';
include_once dirname( __FILE__ ) . '/front/shortcode.php';


