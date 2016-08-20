<?php
/*
  Plugin Name: Our Team Showcase
  Plugin URI: https://smartcatdesign.net/downloads/our-team-showcase/
  Description: Display your team members in a very attractive way as a widget or page with the shortcode [our-team]
  Version: 3.0.0
  Author: SmartCat
  Author URI: https://smartcatdesign.net
  License: GPL v2
 * 
 * @author          Bilal Hassan <bilal@smartcat.ca>
 * @copyright       Smartcat Design <http://smartcatdesign.net>
 * 
 */


if( !defined( 'ABSPATH' ) ) {
    die;
}
if (!defined('SC_TEAM_PATH'))
    define('SC_TEAM_PATH', plugin_dir_path(__FILE__));
if (!defined('SC_TEAM_URL'))
    define('SC_TEAM_URL', plugin_dir_url(__FILE__));


require_once ( plugin_dir_path( __FILE__ ) . 'inc/class/class.smartcat-team.php' );

register_activation_hook( __FILE__, array( 'SmartcatTeamPlugin', 'activate' ) );
register_deactivation_hook( __FILE__, array('SmartcatTeamPlugin', 'deactivate')  );

SmartcatTeamPlugin::instance();


require_once SC_TEAM_PATH . 'admin/class/class-tgm-plugin-activation.php';

//add_action('tgmpa_register', 'sc_team_register_required_plugin');


function sc_team_register_required_plugin() {

    $plugins = array(

        array(
            'name' => 'Reviews & Testimonials Showcase',
            'slug' => 'testimonials-reviews-showcase',
            'required' => false,
        ),
    );
   
    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => false, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.

    );

    tgmpa($plugins, $config);
}
