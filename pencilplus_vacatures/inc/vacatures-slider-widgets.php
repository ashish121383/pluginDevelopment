<?php 
$theme_options = get_option( "pp_vacatures_theme_options" );

function pp_load_vactures_slider_call_back(){
	register_widget('vacatures_slider_widgets');
}

add_action('widgets_init','pp_load_vactures_slider_call_back');

class vacatures_slider_widgets extends WP_Widget{

//Here we are going to set widgets name 
	function __construct(){
	parent::__construct(
		//Base Id of your widgets
		'pp_vacatures_slider_widget',
		//Widgtes Name Appear in UI
		__('Pencilplus Vacatures - Slider'),
		//Widgets Description 
		array('description' => ('Gebruik deze widget om je vacatures te tonen in een slider'))
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
      $vacaturesItemSlider = array();
      $args = array(
          'post_type' => 'vacatures',
          'posts_per_page' => $page_counter
      );
      $loop = new WP_Query($args); 
      if($loop->have_posts()):
        while($loop->have_posts()):$loop->the_post();
          
          $vacaturesItemSlider['id'] = get_the_ID();
          $vacaturesItemSlider['vacatures_link'] = get_the_permalink(get_the_ID());
          $vacaturesItemSlider['site_url'] = site_url();
          $vacaturesItemSlider['vacatures_url_redirect'] = get_post_meta(get_the_ID(),'vacatures_custom_url_redirect',true);

          $vacaturesItemSlider['title'] = get_the_title(get_the_ID());
          $vacaturesItemSlider['subtitle'] = get_post_meta(get_the_ID(),'vacatures_sub_title',true);
          $vacaturesItemSlider['intro'] = wp_trim_words( get_post_meta(get_the_ID(),'vacatures_intro',true), 28,'<span>... <i class="fa fa-angle-right"></i></span>');
          $vacaturesItemSlider['amount_of_hours'] = get_post_meta(get_the_ID(),'vacatures_amount_of_hours',true);
          $vacaturesItemSlider['job_type'] = get_post_meta(get_the_ID(),'vacatures_job_type',true);
          $vacaturesItemSlider['date'] = get_post_meta(get_the_ID(),'vacatures_add_job_date',true);
          $vacaturesItemSlider['job_description'] = get_post_meta(get_the_ID(),'vacatures_job_description',true);
          $vacaturesItemSlider['we_ask'] = get_post_meta(get_the_ID(),'vacatures_job_we_ask',true);
          $vacaturesItemSlider['we_offer'] = get_post_meta(get_the_ID(),'vacatures_job_we_offer',true);
          $vacaturesItemSlider['other'] = get_post_meta(get_the_ID(),'vacatures_other_job_info',true);
          $vacaturesItemSlider['emailaddress_to_apply'] = get_post_meta(get_the_ID(),'vacatures_job_email_address',true);
          $vacaturesItemSlider['featured_image'] = get_post_meta(get_the_ID(),'first_image_file',true);
          if(get_post_meta(get_the_ID(),'profile_contacts_repeatable_fields',true)) {
          $vacaturesItemSlider['contactperson'] = array_filter(get_post_meta(get_the_ID(),'profile_contacts_repeatable_fields',true));  
          }else{
            $vacaturesItemSlider['contactperson'] = '';
          } 
          if(get_post_meta(get_the_ID(),'vacatures_location',true)){
            $vacaturesItemSlider['location'] = array_filter(get_post_meta(get_the_ID(),'vacatures_location',true));
          }else{
            $vacaturesItemSlider['location'] = '';
          }
          
          $smarty->append('vacaturesItemSlider', array_filter($vacaturesItemSlider));
        endwhile;
        wp_reset_postdata();    
      endif;
      $smarty->caching = false;
      $smarty->compile_check = true;
      if($smarty->templateExists('vacatures_slider_template.html'))
          $smarty->display('vacatures_slider_template.html');
      else
          $smarty->display('standard_vacatures_slider_template.html');
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
                                       if($value1=="slider"){
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