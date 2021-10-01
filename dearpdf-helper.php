<?php
/**
 * Plugin Name:     Dearpdf Helper
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     dearpdf-helper
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Dearpdf_Helper
 */


add_action('wp_head', 'pn_header_script');

function pn_header_script(){
?>
<h1>Hello World</h1>
<?php
};