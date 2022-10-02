<?php
//Add a layer to protect against snooping
defined('ABSPATH') or die("No Bueno Amigo."); //Beat it!
/*
Plugin Name: Login Stylizer
Plugin URI: https://dkdesignhawaii.com
Description: Edit this plugin's code to white label the login screen.
Author: Dan Morrone
Version: 1.0
Author URI: https://dkdesignhawaii.com
*/

function ws_admin_theme_style() {
	//This css file is located in this plugin's folder and is invoked both in admin area and on login page.
    wp_enqueue_style('ws-admin-theme', plugins_url('wp-admin.css', __FILE__));
	
	}
add_action('admin_enqueue_scripts', 'ws_admin_theme_style');
add_action('login_enqueue_scripts', 'ws_admin_theme_style');


//New Function add logo edits to the head
add_action('login_head', 'wsPlugLoginLogo');
function wsPlugLoginLogo() {
	echo '<style type="text/css"> 
				body.login div#login h1 a {
            	background-image: url('.site_url().'/wp-content/uploads/2020/09/logo192.png) !important;
            	padding-bottom: 0; background-size:300px; width:300px; height:100px;
        		}
				/*color verison = login-logo.png*/
				/*flat verison = ws-login-logo.png*/
			</style>';
}


function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Go to website';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );



function custom_login_title( $login_title ) {
return str_replace(array( ' &lsaquo;', ' &#8212; WordPress'), array( ' &bull;', ' &bull; Login'),$login_title );
}
add_filter( 'login_title', 'custom_login_title' );

// Hide nags and stuff like that
add_action('admin_head','dkhidnags');
function dkhidnags(){

	if(!current_user_can('manage_options')){
		echo '<style>
				.update-nag,
				.updated.woocommerce-message {
					display:none;
				}
				</style>';
	} //end if

}