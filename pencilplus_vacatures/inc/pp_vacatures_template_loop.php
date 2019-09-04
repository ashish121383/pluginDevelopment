<?php 
get_header();
global $post; 
//wp_enqueue_style( 'news-single-page-template-theme-style' );
$smarty = new Smarty; 
$smarty->setCompileDir(WP_CONTENT_DIR.'/templates/compile');
$smarty->setTemplateDir(array(
     'standard'   => WP_PLUGIN_DIR.'/pencilplus_vacatures/templates',
     'themelayout'   => WP_CONTENT_DIR.'/templates/vacatures-template',
));

// Switch display errors and cleaning compile templates on n the DEV.
if(stristr(content_url(), '.dev') OR stristr(content_url(), 'localhost'))
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$smarty->clearCompiledTemplate();
	$smarty->force_compile = true;
}

//Theme option getting start for page link start 
$options = get_option( 'pp_vacatures_theme_options' );
//Theme option getting start for page link End

// Get taxonomy/tags details
$smarty->assign("template_assets_dir", content_url().'/templates/assets');
$queried_post_type = get_query_var('post_type');
  if ( is_single() && 'vacatures' ==  $queried_post_type ) {
  	  $current_post_id = $post->ID;
      
      $terms = get_the_terms( $current_post_id, 'tags');        
      if ( $terms && ! is_wp_error( $terms ) ) : 
        $links = array();
        $tags_page_link = get_site_url().'/tags/';
        foreach ( $terms as $term ) {
            $termslug = $tags_page_link.$term->slug;
            $links[] = '<a href="' .$termslug. '">' . $term->name.'</a>';
        }
        $tax = "<span>".implode('</span> <span>', $links)."</span>";
        $post_tags = $links;


      else :  
        $tax = '';          
      endif;  
      $singleVacatures = array();
      $args_navigation = array(
            'prev_text'                  => __( 'vorige' ),
            'next_text'                  => __( 'volgende' ),
            );
      $singleVacatures['post_navigations'] = get_the_post_navigation($args_navigation);
      
      $singleVacatures['catName'] = $tax;

      $singleVacatures['vacatures_link'] = get_the_permalink($post->ID);
      $singleVacatures['vacatures_url_redirect'] = get_post_meta(get_the_ID(),'vacatures_custom_url_redirect',true);
      $singleVacatures['id'] = $post->ID;
      $singleVacatures['title'] = get_the_title($post->ID);
      $singleVacatures['subtitle'] = get_post_meta($post->ID,'vacatures_sub_title',true);
      $singleVacatures['intro'] = get_post_meta($post->ID,'vacatures_intro',true);
      $singleVacatures['amount_of_hours'] = get_post_meta($post->ID,'vacatures_amount_of_hours',true);
      $singleVacatures['job_type'] = get_post_meta($post->ID,'vacatures_job_type',true);
      $singleVacatures['date'] = get_post_meta($post->ID,'vacatures_add_job_date',true);
      $singleVacatures['job_description'] = get_post_meta($post->ID,'vacatures_job_description',true);
      $singleVacatures['we_ask'] = get_post_meta($post->ID,'vacatures_job_we_ask',true);
      $singleVacatures['we_offer'] = get_post_meta($post->ID,'vacatures_job_we_offer',true);
      $singleVacatures['other'] = get_post_meta($post->ID,'vacatures_other_job_info',true);
      $singleVacatures['emailaddress_to_apply'] = get_post_meta($post->ID,'vacatures_job_email_address',true);
      $singleVacatures['featured_image'] = get_post_meta($post->ID,'first_image_file',true);
      $singleVacatures['page_button_back_link'] = $options['vacatures_custom_page_link']; 


       if(!empty(get_post_meta($post->ID,'profile_contacts_repeatable_fields',true))){

      $repeatable_fields = array_filter(get_post_meta($post->ID,'profile_contacts_repeatable_fields',true));      
     

       foreach ( $repeatable_fields as $field ) {

               $profiles[]=$field['selectProfileContact'];
             } 
          
          if(!empty($profiles)){
          $profileinfo = join( ",", str_replace(' ', '-', $profiles));    
          foreach ($profiles as $profile) {
          $profile_args = array( 
                    'post_type'  => 'profile',
                    'title'      => $profile
                    ); 
          $custom_query = new WP_Query( $profile_args ); 
          while ( $custom_query->have_posts() ) {
          $custom_query->the_post();
           $single_vacatures_profiles = array();
           $single_vacatures_profiles['profileimg'] = get_post_meta(get_the_ID(),'profile_first_image_file',true);       
           $single_vacatures_profiles['profilelink'] = get_the_permalink();
           $single_vacatures_profiles['profilename'] = get_post_meta(get_the_ID(),'profile_name',true);
           $single_vacatures_profiles['profilefunction'] = get_post_meta(get_the_ID(),'profile_function',true);
           $single_vacatures_profiles['profilequote'] = get_post_meta(get_the_ID(),'quote',true);

           $smarty->append('single_vacatures_profiles', $single_vacatures_profiles);  
              } // while loop ends
        
          }
        }
    }


      if(!empty(get_post_meta($post->ID,'vacatures_location',true))){

        $singleVacatures['location'] = array_filter(get_post_meta($post->ID,'vacatures_location',true));  
      }else{
        $singleVacatures['location'] = '';
      }

		$smarty->append('single_vacatures', $singleVacatures);


		//Showing related post
		//Get array of terms
            //Pluck out the IDs to get an array of IDS
   

      $term_ids = wp_list_pluck($terms,'term_id');
  		$related_args = array (
        'post_type'              => array('vacatures'),
        'nopaging'               => false,
        'posts_per_page'         => '3',
        'ignore_sticky_posts'    => false,
        'post__not_in'           => array($current_post_id)
    );

		$related_vacancy_loop  = new WP_Query($related_args);
		$related_vacancy = array();
		if($related_vacancy_loop->have_posts() ) {
		while($related_vacancy_loop->have_posts()) : $related_vacancy_loop->the_post(); 

			  $related_vacancy['vacatures_link'] = get_the_permalink($post->ID);
         $related_vacancy['vacatures_url_redirect'] = get_post_meta(get_the_ID(),'vacatures_custom_url_redirect',true);
		      $related_vacancy['id'] = $post->ID;
		      $related_vacancy['title'] = get_the_title($post->ID);
		      $related_vacancy['subtitle'] = get_post_meta($post->ID,'vacatures_sub_title',true);
		      $intro = get_post_meta(get_the_ID(),'vacatures_intro',true);
          $related_vacancy['intro'] = substr(strip_tags($intro), 0, 180);
		      $related_vacancy['amount_of_hours'] = get_post_meta($post->ID,'vacatures_amount_of_hours',true);
		      $related_vacancy['job_type'] = get_post_meta($post->ID,'vacatures_job_type',true);
		      $related_vacancy['date'] = get_post_meta($post->ID,'vacatures_add_job_date',true);
		      $related_vacancy['job_description'] = get_post_meta($post->ID,'vacatures_job_description',true);
		      $related_vacancy['we_ask'] = get_post_meta($post->ID,'vacatures_job_we_ask',true);
		      $related_vacancy['we_offer'] = get_post_meta($post->ID,'vacatures_job_we_offer',true);
		      $related_vacancy['other'] = get_post_meta($post->ID,'vacatures_other_job_info',true);
		      $related_vacancy['emailaddress_to_apply'] = get_post_meta($post->ID,'vacatures_job_email_address',true);
		      $related_vacancy['featured_image'] = get_post_meta($post->ID,'first_image_file',true);

		      if(!empty(get_post_meta($post->ID,'profile_contacts_repeatable_fields',true))){

			   $related_vacancy['contactperson'] = array_filter(get_post_meta($post->ID,'profile_contacts_repeatable_fields',true));
    			}else{

    		   $related_vacancy['contactperson'] = '';
			 }

    		  if(!empty(get_post_meta($post->ID,'vacatures_location',true))){

       		 $related_vacancy['location'] = array_filter(get_post_meta($post->ID,'vacatures_location',true)); 

     		 }else{
     		   $related_vacancy['location'] = '';
    		  }

    		 $smarty->append('related_vacancy', $related_vacancy);
		
		endwhile;
		}
		wp_reset_query();
 
		      
 }
 $smarty->caching = false;
 $smarty->compile_check = true;
 if($smarty->templateExists('vacatures_single_page_theme_template.html'))
      $smarty->display('vacatures_single_page_theme_template.html');
     else
      $smarty->display('standard_vacatures_single_page_template.html');
 ?>

<?php get_footer();
?>