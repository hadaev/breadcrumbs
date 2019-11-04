<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Breadcrumbs
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
//delete option
delete_option('true_options');
//delete_option('bc_shortcode');
//delete_option('bc_position');
//delete_option('show_home_link');
//delete_option('show_on_home');
//delete_option('show_current');
//delete_option('bc_sep');
//delete_option('bc_color_bg');
//delete_option('bc_color_sep');
//delete_option('bc_color');
//delete_option('bc_color_current');
//delete_option('bc_text_home');
//delete_option('bc_text_search');
//delete_option('bc_text_tag');
//delete_option('bc_text_author');
//delete_option('bc_text_404');
//delete_option('bc_text_pagination');
//delete_option('bc_text_comment');
//delete_option('bc_check_sep');
