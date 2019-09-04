<?php 
/*
plugin Name: Pencilplus - Vacatures
Description: Create a Vacatures menu and fields on admin panel.
Author: Pencilplus
Version: 1.0
License: GLP12
Author URI: http://pencilpoint.nl/
Plugin URI: http://pencilpoint.nl/
*/

if( !defined('THEME_DIR'))
    define( 'THEME_DIR', get_template_directory());
if( !defined('WP_PLUGIN_DIR'))
    define( 'WP_PLUGIN_DIR', site_url());
if( !defined('WP_CONTENT_DIR') )
    define( 'WP_CONTENT_DIR', site_url());

/* Add vacatures scripts/style starts */
add_action('wp_enqueue_scripts', 'callback_for_setting_vacatures_scripts');

function callback_for_setting_vacatures_scripts() {
    wp_register_style('vacatures_standard_style', plugin_dir_url( __FILE__ ) .'assets/css/vacatures-standard-style.css');
    wp_enqueue_style('vacatures_standard_style' );
    wp_register_style('vacatures_single_page_template_style', plugin_dir_url( __FILE__ ) .'assets/css/vacatures-single-page-template-theme-style.css');
    wp_enqueue_style('vacatures_single_page_template_style' );

    wp_register_style( 'vacatures_template_style', content_url( 'templates/assets/css/vacatures_template_style.css' , __FILE__ ) );
    wp_enqueue_style( 'vacatures_template_style' );
}
/* Add vacatures scripts/style ends */

add_action('admin_enqueue_scripts', 'vacatures_script_call_back');
function vacatures_script_call_back() {
    // wp_enqueue_script( 'jqueryscript', 'https://cdn.jsdelivr.net/jquery/latest/jquery.min.js', array( 'jquery' ) );
      wp_register_style( 'calendra-css', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css' );
    wp_enqueue_style('calendra-css');
    wp_register_style('admin-custom-css', plugin_dir_url( __FILE__ ) .'assets/css/vacatures-admin.css');
    wp_enqueue_style('admin-custom-css');
    wp_enqueue_script('momentscript-js', 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', array( 'jquery' ) );
    wp_enqueue_script('daterangepickerscript-js', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array( 'jquery' ) ); 

    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'assets/js/admin_custom_meta_box_section.js', array(), '1.0',true );



    


}


/* Include smarty library starts*/
$themedir = get_template_directory();
require_once $themedir.'/libs/Smarty.class.php';
/* Include smarty library ends*/

/*Include create vacatures Custom Post Type  Start */
include( plugin_dir_path( __FILE__ ) . '/inc/vacatures-post-type.php');
/*Include create vacatures Custom Post Type  End */

/*Create add meta box of job post type */
include( plugin_dir_path( __FILE__ ) . '/inc/vacatures-add-meta-boxes.php');
/*End add meta box of job post type */


/*Create setting submenu of job post type */
include( plugin_dir_path( __FILE__ ) . '/inc/add_settings_submenu.php');
/*Create setting submenu of job post type  End*/


/*Create widgets list-widgets of job post type */
include( plugin_dir_path( __FILE__ ) . '/inc/vacatures-list-widgets.php');
/*Include widgets create list-widgets  End */

/*Include create vacatures widgets slider-widgets Custom Post Type  Start */
include( plugin_dir_path( __FILE__ ) . '/inc/vacatures-slider-widgets.php');
/*Include create vacatures widgets slider-widgets Custom Post Type  End */


/*Include create vacatures widgets list-filter-by-tag Custom Post Type  Start */
include( plugin_dir_path( __FILE__ ) . '/inc/vacatures-list-filter-by-tag.php');
/*Include create vacatures widgets list-filter-by-tagCustom Post Type  End */


/*Include create vacatures widgets slider-filter-by-tag Custom Post Type  Start */
include( plugin_dir_path( __FILE__ ) . '/inc/vacatures-slider-filter-by-tag.php');
/*Include create vacatures widgets slider-filter-by-tag Custom Post Type  End */

//Include single blog template
include( plugin_dir_path( __FILE__ ) . '/inc/pp-vacatures-template.php' );



?>
