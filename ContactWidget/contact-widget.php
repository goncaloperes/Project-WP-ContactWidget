<?php
/*
Plugin Name:  WP Contact Widget (AJAX)
Description:  My first simple AJAX powered contact form widget.
Version:      1.0
Author:       Gonçalo Peres
Author URI:   https://goncaloperes.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /languages
*/


/*
 * Include JavaScript
 */
function add_scripts()
{
    wp_enqueue_script('contact-scripts', plugins_url().'/contact-widget/js/script.js', array('jquery'), '1.0.0', false);
}

add_action('wp_enqueue_scripts', 'add_scripts');


/*
 * Incluce Widget Class
 */
include ('class.contact-widget.php');


/*
 * Register Widget
 */
function register_contact_widget()
{
    register_widget('Contact_Widget');
}

add_action('widgets_init', 'register_contact_widget');