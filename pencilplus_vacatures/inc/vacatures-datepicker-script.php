<?php

add_action( 'in_admin_footer', 'my_custom_script_load' );
function my_custom_script_load(){
  wp_enqueue_script( 'my-jquery-min', 'https://cdn.jsdelivr.net/jquery/latest/jquery.min.js', array( 'jquery' ) );
  wp_enqueue_script( 'my-moment-script', 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', array( 'jquery' ) );
  wp_enqueue_script( 'my-daterangepicker-script', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array( 'jquery' ) );

  wp_register_style('my-daterangepicker-script', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css');
    wp_enqueue_style('my-daterangepicker-script');
  
}




