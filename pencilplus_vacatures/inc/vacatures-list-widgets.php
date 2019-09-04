<?php 
$theme_options = get_option( "pp_vacatures_theme_options" );

function pp_load_vactures_list_widget(){
	register_widget('vacatures_widgets');
}

add_action('widgets_init','pp_load_vactures_list_widget');

class vacatures_widgets extends WP_Widget{

//Here we are going to set widgets name 
	function __construct(){
	parent::__construct(
		//Base Id of your widgets
		'pp_vacatures_list_widget',
		//Widgtes Name Appear in UI
		__('Pencilplus Vacatures - Lijst'),
		//Widgets Description 
		array('description' => ('Gebruik deze widget om je vacaturelijst te tonen'))
		);
	}

	public function widget($args,$instance){
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

      $smarty->assign("layouts", $instance['layout_type']);
      $smarty->assign("assets_dir", content_url().'/templates/assets');
      $page_counter = $instance['counter'];
      $vacaturesItemList = array();
      $args = array(
          'post_type' => 'vacatures',
          'posts_per_page' => $page_counter
      );
      $loop = new WP_Query($args); 
      if($loop->have_posts()):
        while($loop->have_posts()):$loop->the_post();
          $vacaturesItemList['id'] = get_the_ID();
          $vacaturesItemList['title'] = get_the_title(get_the_ID());
          $vacaturesItemList['subtitle'] = get_post_meta(get_the_ID(),'vacatures_sub_title',true);
          
          $vacaturesItemList['intro'] = wp_trim_words( get_post_meta(get_the_ID(),'vacatures_intro',true), 28,'<span>... <i class="fa fa-angle-right"></i></span>');
          $vacaturesItemList['amount_of_hours'] = get_post_meta(get_the_ID(),'vacatures_amount_of_hours',true);
          $vacaturesItemList['job_type'] = get_post_meta(get_the_ID(),'vacatures_job_type',true);
          $vacaturesItemList['date'] = get_post_meta(get_the_ID(),'vacatures_add_job_date',true);
          $vacaturesItemList['job_description'] = get_post_meta(get_the_ID(),'vacatures_job_description',true);
          $vacaturesItemList['we_ask'] = substr(strip_tags( get_post_meta(get_the_ID(),'vacatures_job_we_ask',true)), 0, 180);
          $vacaturesItemList['we_offer'] = get_post_meta(get_the_ID(),'vacatures_job_we_offer',true);
          $vacaturesItemList['other'] = get_post_meta(get_the_ID(),'vacatures_other_job_info',true);
          $vacaturesItemList['emailaddress_to_apply'] = get_post_meta(get_the_ID(),'vacatures_job_email_address',true);
          $vacaturesItemList['featured_image'] = get_post_meta(get_the_ID(),'first_image_file',true);
           $vacaturesItemList['site_url'] = site_url();
          $vacaturesItemList['vacatures_link'] = get_the_permalink(get_the_ID());
          $vacaturesItemList['vacatures_url_redirect'] = get_post_meta(get_the_ID(),'vacatures_custom_url_redirect',true);
          
          if(!empty(get_post_meta(get_the_ID(),'profile_contacts_repeatable_fields',true))){

                  $repeatable_fields = array_filter(get_post_meta(get_the_ID(),'profile_contacts_repeatable_fields',true));      
                 

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
                       $profile_data = array();
                       $profile_data['profileimg'] = get_post_meta(get_the_ID(),'profile_first_image_file',true);       
                       $profile_data['profilelink'] = get_the_permalink(get_the_ID());
                       $profile_data['profilename'] = get_post_meta(get_the_ID(),'profile_name',true);
                       $profile_data['profilefunction'] = get_post_meta(get_the_ID(),'profile_function',true);
                       $profile_data['profilequote'] = get_post_meta(get_the_ID(),'quote',true);

                       $smarty->append('profile_data', $profile_data);  
                          } // while loop ends
                    
                      }
                    }
                }

                 if(!empty(get_post_meta(get_the_ID(),'vacatures_location',true))){

                   $vacaturesItemList['location'] = array_filter(get_post_meta(get_the_ID(),'vacatures_location',true));
                 }

          
          $smarty->append('vacaturesItemList', $vacaturesItemList);
        endwhile;
        wp_reset_postdata();    
      endif;
      $smarty->caching = false;
      $smarty->compile_check = true;
      if($smarty->templateExists('vacatures_list_template.html'))
          $smarty->display('vacatures_list_template.html');
      else
          $smarty->display('standard_vacatures_list_template.html');
    }

	public function form($instance){
		$counter = esc_attr($instance['counter']);
		$layout_type = esc_attr($instance['layout_type']);
		?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"><br></div>
			<table class="wp-list-table widefat pp_vacatures_theme_options" cellspacing="0">
				<thead>
                      <tr>
                          <td style="width:20%"><b><?php _e( 'Opties', 'pp_theme' );?></b></td>
                          <td style="width:80%">&nbsp;</td>
                      </tr>
                </thead>
                <tbody>    
					<tr>
                        <td>
                        	<div class="container">
                        		<div class="style-field-wrapper">
     								<label for="<?php echo $this->get_field_id('counter'); ?>"><?php _e('Aantal vacatures dat getoond moet worden (gebruik -1 om alles te tonen)'); ?></label>
   								 <input class="widefat" id="<?php echo $this->get_field_id('counter'); ?>" name="<?php echo $this->get_field_name('counter'); ?>" type="number" value="<?php echo  !empty($counter) ? $counter : -1; ; ?>" min="-1"/>
    							</div>
                        	</div>
                        </td>
                      </tr>	
                      <tr>
                        <td>
                        	<div class="container">
                        		<div class="style-field-wrapper">
             								 <label for="<?php echo $this->get_field_id('layout_type'); ?>"><?php _e('Layout Type'); ?></label>
             								  <select id="<?php echo $this->get_field_id('layout_type'); ?>" name="<?php echo $this->get_field_name('layout_type'); ?>">
                                  <?php 
                                  $theme_options = get_option( "pp_vacatures_theme_options" );
                                  $layoutName = $theme_options['pp_vacatures_header_option_texts'];
                                  $layoutValue = $theme_options ['pp_vacatures_header_option_values']; 
                                  $array = $layoutName;
                                  foreach($array as $textkey=>$textvalue){
                                       $resultArr[]  = $textvalue;
                                   }
                                  foreach($layoutValue as $key=>$value1){
                                    if (!is_numeric($key)) {
                                       if($value1=="list"){
                                         $selectLayout = str_replace("_", " ", $key); ?>
                                         <option <?php selected($instance['layout_type'], $selectLayout);?> value="<?php echo $selectLayout; ?>"><?php echo $selectLayout; ?></option>
                                       <?php } 
                                    }  
                                  }
                                  ?>
                                </select>
                        	</div>
                        </td>
                      </tr>	
                </tbody>    
			</table>
		</div>
		<?php 
	}

	public function update($new_instance,$old_instance){
		$instance = $old_instance;
	  	$instance['counter'] = strip_tags($new_instance['counter']);
	  	$instance['layout_type'] = strip_tags($new_instance['layout_type']);
	  	return $instance;
	}

}


?>