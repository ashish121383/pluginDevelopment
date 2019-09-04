<?php
// Include Single vacatures Page Template
/* ========== START REGISTER vacatures SINGLE PAGE TEMPLATE ========== */
 add_action('wp_enqueue_scripts', 'vacatures_single_style_scripts', 10);
    function vacatures_single_style_scripts() {
   // wp_register_style( 'vacatures-single-page-template-theme-style', content_url( 'templates/assets/css/vacatures-single-page-template-theme-style.css' , _FILE_ ) );
     //wp_enqueue_style( 'vacatures-single-page-template-theme-style' );
     wp_enqueue_style('vacatures-single-page-template-theme-style',content_url( 'templates/assets/css/vacatures-single-page-template-theme-style.css' , __FILE__ ) );
}
if( !function_exists('pp_get_vacatures_single_page_template') ):
 function pp_get_vacatures_single_page_template($single_template) {
    global $wp_query, $post;
   	
    if ($post->post_type == 'vacatures'){
        $single_template = plugin_dir_path(__FILE__) . '/pp_vacatures_template_loop.php';
    }//end if MY_CUSTOM_POST_TYPE
    return $single_template;
}//end pp_get_vacatures_single_page_template function
endif;
 
add_filter( 'single_template', 'pp_get_vacatures_single_page_template' ) ;
/* ========== END REGISTER vacatures SINGLE PAGE TEMPLATE ========== */

/* If archive page template start */

function some_func( $query ){
    if ( (is_post_type_archive('vacatures') && !is_admin()) ) {
         $settings = get_option( "pp_vacatures_theme_options" );
         header('Location:'.home_url($settings['vacatures_custom_page_link']));
    }
}
add_action('pre_get_posts','some_func');

/* If archive page template end */

