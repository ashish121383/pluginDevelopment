<?php
function get_profile_options_on_vacatures() {
$profilesArray = array();
$jobs = new WP_Query( array( 'post_type' => 'profile','orderby=title&order=DESC') ); 
global $post;
if($jobs->have_posts()){
    while ($jobs->have_posts()):$jobs->the_post();
        $profilesArray[] = $post->post_title;
        $options = $profilesArray;
    endwhile;
}else{
	    $options[] = 'Select one';
	    $options[] = 'Select Two';
}

return $options;
}
/* Add porfolio metaboxes starts */

// Change title of job post type start section 
add_filter('gettext','custom_enter_title');

function custom_enter_title( $input ) {
    global $post_type;
    if( is_admin() && 'Enter title here' == $input && 'vacatures' == $post_type )
        return 'Functienaam';
    return $input;
}
// End section 

add_action( 'admin_init', 'add_metaboxes_vacatures' );
//Add custom fields function starts
function add_metaboxes_vacatures() {
	$options = get_option( 'pp_vacatures_theme_options' );

	$vacatures_subtitle_st = $options['vacatures_subtitle_st'];
	$vacatures_custom_url_redirect_st = $options['vacatures_custom_url_redirect_st'];
    $vacatures_intro_st =    $options['vacatures_intro_st'];
    
    $vacatures_amount_of_hours_st =  $options['vacatures_amount_of_hours_st'];
    $vacatures_job_type_st = $options['vacatures_job_type_st'];
    $vacatures_date_st = $options['vacatures_date_st'];
    $vacatures_job_description_st = $options['vacatures_job_description_st'];
    $vacatures_we_ask_st = $options['vacatures_we_ask_st'];
    $vacatures_we_offer_st = $options['vacatures_we_offer_st'];
    $vacatures_other_st =  $options['vacatures_other_st'] ;
    $vacatures_email_address_to_apply_st = $options['vacatures_email_address_to_apply_st'];
    $vacatures_highlighted_picture_st = $options['vacatures_highlighted_picture_st'] ;
    $vacatures_contact_st = $options['vacatures_contact_st'] ;
    
    $vacatures_location_st = $options['vacatures_location_st'] ;

    $vacatures_second_image_picture_st = $options['vacatures_second_image_picture_st'] ;

    if($vacatures_subtitle_st == 'true'){
    	//vacatures Sub title custom field
    	add_meta_box( 'vacatures-subtitle','Subtitel','vacatures_subtitle_callback','vacatures', 'normal');	
    }else{
    	remove_meta_box('vacatures-subtitle','vacatures','normal');
    }


     if($vacatures_custom_url_redirect_st == 'true'){
    	//vacatures Sub title custom field
    	add_meta_box( 'vacatures-url-redirect','Url Redirect','vacatures_custom_url_redirect_callback','vacatures', 'normal');	
    }else{
    	remove_meta_box('vacatures-subtitle','vacatures','normal');
    }

    if($vacatures_intro_st == 'true'){ 
    	//vacatures intro custom field 
	add_meta_box( 'vacatures-intro','Intro','vacatures_intro_callback','vacatures', 'normal');	
    }else{
    	remove_meta_box('vacatures-intro','vacatures','normal');

    }

    if($vacatures_amount_of_hours_st == 'true'){ 
	//Amount of hours custom field start 
	add_meta_box( 'vacatures-amount-of-hours','Aantal uren','vacatures_amount_of_hours_callback','vacatures', 'normal');	
	//Amount of hours custom field end
    }else{
    	remove_meta_box('vacatures-amount-of-hours','vacatures','normal');
    }

    if($vacatures_job_type_st == 'true'){ 
	//Amount of hours custom field start 
	add_meta_box( 'vacatures-job-type','Type dienstverband','vacatures_job_type_callback','vacatures', 'normal');	
	//Amount of hours custom field end
    }else{
    	remove_meta_box('vacatures-job-type','vacatures','normal');
    }


	if($vacatures_date_st == 'true'){ 
	//Date addition  start
	add_meta_box('vacatures-job-date-addition','Datum','vacatures_date_addition_callback','vacatures', 'normal');
	//Date addition end 
	}else{
		remove_meta_box('vacatures-job-date-addition','vacatures','normal');
	}

	if($vacatures_job_description_st == 'true'){ 
	//Job description Start
	add_meta_box('vacatures-job-description','Functieomschrijving','vacatures_job_description_callback','vacatures', 'normal');	
	//Job description End 
	}else{
		remove_meta_box('vacatures-job-description','vacatures','normal');
	}

	if($vacatures_we_ask_st == 'true'){
		
		//Job we ask Start
		add_meta_box('vacatures-job-we-ask','Wij vragen','vacatures_job_we_ask_callback','vacatures', 'normal');	
		//Job we ask End 	
	}else{
		remove_meta_box('vacatures-job-we-ask','vacatures','normal');	
	}
	
	if($vacatures_we_offer_st == 'true'){
		//Job we offer Start
		add_meta_box('vacatures-job-we-offer','Wij bieden','vacatures_job_we_offer_callback','vacatures', 'normal');	
		//Job we offer End 
	}else{
		remove_meta_box('vacatures-job-we-offer','vacatures','normal');	
	}	
	
	if($vacatures_other_st == 'true'){
		//Job other description Start
		add_meta_box('vacatures-other-job-info','Overig','vacatures_other_job_info_callback','vacatures', 'normal');	
		//Job other description End 
	
	}else{
		remove_meta_box('vacatures-other-job-info','vacatures','normal');	
	}

	if($vacatures_email_address_to_apply_st == 'true'){
		//Apply for job start
		add_meta_box('vacatures-apply-job-email-address','E-mailadres voor solliciteren','vacatures_apply_job_callback','vacatures', 'normal');	
		//Apply for Job End 
	
	}else{
		remove_meta_box('vacatures-apply-job-email-address','vacatures','normal');		
	}
	

	if($vacatures_highlighted_picture_st == 'true'){
	//vacatures Active custom field 
	/*add_meta_box( 'vacatures_active','Active','vacatures_active_callback','vacatures', 'side');*/
    //vacatures First Image custom field
    add_meta_box( 'vacatures-first-image','Uitgelichte afbeelding','vacatures_first_image_callback','vacatures', 'side');
	}else{
		remove_meta_box('vacatures-first-image','vacatures','side');
	}

	
      
    //vacatures Location custom field 
    if($vacatures_location_st == 'true'){
		add_meta_box( 'vacatures-job-location','Locatie','vacatures_location_callback','vacatures', 'normal');
	}else{
		remove_meta_box('vacatures-job-location','vacatures','normal');	
	}

	if($vacatures_contact_st == 'true'){
		//vacatures Contacts custom field
		add_meta_box( 'vacatures-contacts','Contactpersoon','vacatures_profile_contacts_callback','vacatures', 'normal');	
	}else{
		remove_meta_box('vacatures-contacts','vacatures','normal');
	}
	
	    
}
/* Here I have done all changes */
function vacatures_job_we_ask_callback($job_ask){
	$job_ask_value = get_post_meta( $job_ask->ID, 'vacatures_job_we_ask', true );
		$editor_id = 'vacatures_job_we_ask';
	wp_editor( $job_ask_value, $editor_id,array("media_buttons" => true ));
}

function vacatures_job_we_offer_callback($job_we_offer){
	$job_offer_value = get_post_meta( $job_we_offer->ID, 'vacatures_job_we_offer', true );
		$editor_id = 'vacatures_job_we_offer';
		wp_editor( $job_offer_value, $editor_id );
}

function vacatures_other_job_info_callback($other_job_info){
	$other_job_value = get_post_meta( $other_job_info->ID, 'vacatures_other_job_info', true );
		$editor_id = 'vacatures_other_job_info';
		wp_editor( $other_job_value, $editor_id );
}

function vacatures_apply_job_callback($job_apply){
	$job_apply_value = get_post_meta( $job_apply->ID, 'vacatures_job_email_address', true );
	if(empty($job_apply_value)){
		?>
	<input type="email" id="vacatures_job_email_id" name="vacatures_job_email_address">
	<?php 	
	}else{
		?>
		<input type="email" id="vacatures_job_email_id" name="vacatures_job_email_address" value="<?php echo $job_apply_value; ?>">
		<?php 
	}
		
}

// Changes list disappear
//Include Job description start 
function vacatures_job_description_callback($job_description){
	$job_details_value = get_post_meta( $job_description->ID, 'vacatures_job_description', true );
		$editor_id = 'vacatures_job_description';
		wp_editor( $job_details_value, $editor_id );
}
// Job Description End

//Date job addition start
function vacatures_date_addition_callback($date_addition){
	$date_addition_value = get_post_meta($date_addition->ID,'vacatures_add_job_date',true);
	if(empty($date_addition_value)){
		?>
	<input type="text" id="vacatures_add_job_date_id" name="vacatures_add_job_date">
	<?php 
	}else{  ?>
	<input type="text" id="vacatures_add_job_date_id" name="vacatures_add_job_date" value="<?php echo $date_addition_value; ?>" />
	<?php 
	}
	?>
	<script>
		jQuery(document).ready(function() {
			jQuery('#vacatures_add_job_date_id').datepicker();
		});
	</script>
	<?php
}
//Date job addition end

//Job type callback start 
function vacatures_job_type_callback($job){
	$job_type_value = get_post_meta($job->ID,'vacatures_job_type',true);
	
	if(empty($job_type_value)){
		?>
		<input type="text" id="vacatures_job_type_id" name="vacatures_job_type" >
	<?php 
	}else{ ?>
			<input type="text" id="vacatures_job_type_id" name="vacatures_job_type" value="<?php echo $job_type_value; ?>" />
	<?php
	}
}
// Job type callback end

//Amount of hours callback start 
function vacatures_amount_of_hours_callback($post){
	$amount_of_hours_value = get_post_meta( $post->ID, 'vacatures_amount_of_hours', true );
	/*var_dump($start_date_value);*/
	if($amount_of_hours_value == ""){ ?>
			<input type="text" id="vacatures_amount_of_hours_id" name="vacatures_amount_of_hours" >
	<?php }else{ ?>
		<input type="text" id="vacatures_amount_of_hours_id" name="vacatures_amount_of_hours" value="<?php echo $amount_of_hours_value; ?>">
	<?php } 
}

//Amount of hours callback end 
//Add custom fields function Ends here
	//vacatures Start Date callback function
	
	

//vacatures Sub title callback function starts
function vacatures_subtitle_callback($subtitle){
	$sub_title_value = get_post_meta( $subtitle->ID, 'vacatures_sub_title', true );
	if($sub_title_value == ""){ ?>
		<input type="text" id="vacatures_sub_title" name="vacatures_sub_title" size="75" value=""  spellcheck="true" autocomplete="off">
	<?php }else{ ?>
		<input type="text" id="vacatures_sub_title" name="vacatures_sub_title" size="75" value="<?php echo $sub_title_value ?>"  spellcheck="true" autocomplete="off">
	<?php }
}
//vacatures Sub title callback function ends

function vacatures_custom_url_redirect_callback($urlredirect){
	$vacatures_custom_url_redirect = get_post_meta( $urlredirect->ID, 'vacatures_custom_url_redirect', true );
	
	if($vacatures_custom_url_redirect == ""){ ?>
		<input type="text" id="vacatures_custom_url_redirect" name="vacatures_custom_url_redirect" size="75" value=""  spellcheck="true" autocomplete="off">
	<?php }else{ ?>
		<input type="text" id="vacatures_custom_url_redirect" name="vacatures_custom_url_redirect" size="75" value="<?php echo $vacatures_custom_url_redirect; ?>"  spellcheck="true" autocomplete="off">
	<?php }

}


//vacatures Link(URL) callback function starts
function vacatures_link_callback($link){
	$link_value = get_post_meta( $link->ID, 'vacatures_link', true );
	if($link_value == ""){ ?>
		<input type="url" id="vacatures_link" name="vacatures_link" size="75" value="" >
	<?php }else{ ?>
		<input type="url" id="vacatures_link" name="vacatures_link" size="75" value="<?php echo $link_value ?>" >
	<?php }
}
//vacatures Link(URL) callback function ends



function vacatures_intro_callback($intro){
		$intro_value = get_post_meta( $intro->ID, 'vacatures_intro', true );
		$editor_id = 'vacatures_intro';
		wp_editor( $intro_value, $editor_id );
}

//vacatures Location callback function starts
function vacatures_location_callback($location){
	$location_value = get_post_meta( $location->ID, 'vacatures_location', true );
	wp_nonce_field( 'job_location_repeatable_meta_box_nonce', 'job_location_repeatable_meta_box_nonce' );
		   ?> 
	<script type="text/javascript">
	jQuery(document).ready(function( $ ){
		$( '#add-location-row' ).on('click', function() {
			var row = $( '.empty-row.screen-reader-location' ).clone(true);
			row.removeClass( 'empty-row screen-reader-location' );
			row.insertBefore( '#job-location-repeatable-fieldset-one tbody>tr:last' );
			return false;
		});
		$( '.remove-row-profile-location' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});
	});
	</script>
	<table id="job-location-repeatable-fieldset-one" width="100%">
	<tbody>
	<?php
	/*var_dump($repeatable_fields);*/
	if(is_array($location_value)):
		$count = count($location_value);
		for($i=0; $i<$count; $i++){
		?>
	<tr>
		<td>
			<input type="text" name="vacatures_location[]" id="address" style="width: 500px;" value="<?php echo $location_value[$i]; ?>"/>
		</td>
		<td><a class="button remove-row-profile-location" href="#">Remove</a></td>
	</tr>
	<?php
		}
	else :
	// show a blank one
	?>
	<tr>
		<td>
			<input type="text" name="vacatures_location[]" id="address" style="width: 500px;" />
		</td>
		<td><a class="button remove-row-profile-contacts" href="#">Remove</a></td>
	</tr>
	<?php endif; ?>
	<!-- empty hidden one for jQuery -->
	<tr class="empty-row screen-reader-location">
		<td>
			<input type="text" name="vacatures_location[]" id="address" style="width: 500px;" />
		</td>
		<td><a class="button remove-row-profile-contacts" href="#">Remove</a></td>
	</tr>
	</tbody>
	</table>
	<p><a id="add-location-row" class="button" href="#">Add another</a></p>
       <?php 
}
//vacatures Location callback function ends


//vacatures Profile Contacts callback callback function starts
function vacatures_profile_contacts_callback($profileContacts){
	global $post;
	$profile_options = get_profile_options_on_vacatures();
	$profile_contacts_repeatable_fields = get_post_meta($profileContacts->ID, 'profile_contacts_repeatable_fields', true);
	//$profile_contacts_options = get_profile_options_on_vacatures();
	wp_nonce_field( 'profile_contacts_repeatable_meta_box_nonce', 'profile_contacts_repeatable_meta_box_nonce' );
	?>
	<script type="text/javascript">
	jQuery(document).ready(function( $ ){
		$( '#add-profile-contact-row' ).on('click', function() {
			var row = $( '.empty-row.screen-reader-text' ).clone(true);
			row.removeClass( 'empty-row screen-reader-text' );
			row.insertBefore( '#profile-contacts-repeatable-fieldset-one tbody>tr:last' );
			return false;
		});
		$( '.remove-row-profile-contacts' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});
	});
	</script>
	<table id="profile-contacts-repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th width="32%">Select Profile</th>
			<th width="10%"></th>
		</tr>
	</thead>
	<tbody>
	<?php
	/*var_dump($repeatable_fields);*/
	if ( $profile_contacts_repeatable_fields ) :
	foreach ( $profile_contacts_repeatable_fields as $field ) {
	?>
	<tr>
		<td>
			<select name="selectProfileContact[]" class="selectprofile" style="width: 100%">
			<option value=""Select Profile selected>Select Profile</option>
			<?php foreach ( $profile_options as $label => $value ) : ?>
			<option value="<?php echo $value; ?>"<?php selected( $field['selectProfileContact'], $value ); ?>><?php echo $value; ?></option>
			<?php endforeach; ?>
			</select>
		</td>
		<td><a class="button remove-row-profile-contacts" href="#">Remove</a></td>
	</tr>
	<?php
	}
	else :
	// show a blank one
	?>
	<tr>
		<td>
			<select name="selectProfileContact[]" class="selectprofile" style="width: 100%">
			<option value=""Select Profile selected>Select Profile</option>	
			<?php foreach ( $profile_options as $label => $value ) : ?>
			<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
			<?php endforeach; ?>
			</select>
		</td>
		<td><a class="button remove-row-profile-contacts" href="#">Remove</a></td>
	</tr>
	<?php endif; ?>
	<!-- empty hidden one for jQuery -->
	<tr class="empty-row screen-reader-text">
		<td>
			<select name="selectProfileContact[]" class="selectprofile" style="width: 100%">
			<option value=""Select Profile selected>Select Profile</option>
			<?php foreach ( $profile_options as $label => $value ) : ?>
			<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
			<?php endforeach; ?>
			</select>
		</td>
		<td><a class="button remove-row-profile-contacts" href="#">Remove</a></td>
	</tr>
	</tbody>
	</table>
	<p><a id="add-profile-contact-row" class="button" href="#">Add another</a></p>
	<?php
}
//vacatures Profile Contacts callback function ends


//vacatures active callback function starts
function vacatures_active_callback($active){
	$active_value = get_post_meta( $active->ID, 'vacatures_active', true );
	if($active_value == "no"){  ?>
		<input type="checkbox" id="vacatures_active" name="vacatures_active" value="no">vacatures Active
	<?php }else{ ?>
		<input type="checkbox" id="vacatures_active" name="vacatures_active" value="yes" checked="checked">vacatures Active
	<?php }
}
//vacatures active callback function ends

//vacatures Image A callback function starts
function vacatures_first_image_callback($first_image){
	global $wpdb;
	$first_image_value = get_post_meta( $first_image->ID, 'first_image_file', true );
	$first_image_media_file = get_post_meta( $first_image->ID, $key = '_wp_attached_file', true );
    if (!empty($first_image_media_file)) {
        $first_image_value = $first_image_media_file;
    } ?>

   
    <div>
        <table>
            <tr valign = "top">
                <td>
                    <?php if(!empty($first_image_value)) { ?>
                    <img width="250" height="200" id = "first_image_img" src="<?php echo $first_image_value; ?>" ></br></br>
                    <?php } else{ ?>

                    <img width="250" style="display:none;" height="200" id = "first_image_img" src="<?php echo $first_image_value; ?>" ></br></br>

                     <?php } ?>

                    <input type = "hidden" name = "first_image_file" id = "first_image_file" size = "70" value = "<?php echo $first_image_value; ?>" />
                    <input id = "first_image_button" type = "button" value = "Upload First Image">
                    <div class="image-preview"><img src="<?php echo $meta['image']; ?>" style="max-width: 250px;"></div>
                </td> 
            </tr> 
        </table>
        <input type = "hidden" name = "img_txt_id" id = "img_txt_id" value = "" />
    </div>

     <script type = "text/javascript">
       		 var file_frame_one;
        jQuery('#first_image_button').live('click', function(logo) {
            logo.preventDefault();
            // If the media frame already exists, reopen it.
            if (file_frame_one) {
                file_frame_one.open();
                return;
            }
            // Create the media frame.
            file_frame_one = wp.media.frames.file_frame = wp.media({
                title: jQuery(this).data('uploader_title_logo'),
                button: {
                    text: jQuery(this).data('uploader_button_text_logo'),
                },
                multiple: false // Set to true to allow multiple files to be selected
            });
            // When a file is selected, run a callback.
            file_frame_one.on('select', function(){
                // We set multiple to false so only get one image from the uploader
                attachment = file_frame_one.state().get('selection').first().toJSON();
                var url = attachment.url;

                var field = document.getElementById("first_image_file");
                var image = document.getElementById("first_image_img");
                image.src = url;
                field.value = url; //set which variable you want the field to have
                image.style.display = "block";

            });
            // Finally, open the modal
            file_frame_one.open();
        });


        
	

    </script>
    <?php
    function vacatures_admin_scripts_first_image() {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }
    function vacatures_admin_styles_first_image() {
        wp_enqueue_style('thickbox');
    }
    add_action('admin_print_scripts', 'vacatures_admin_scripts_first_image');
    add_action('admin_print_styles', 'vacatures_admin_styles_first_image');	    
}
//vacatures Image A callback function ends

	

/*Save vacatures Meta Fields Value starts*/
add_action('save_post','save_vacatures_meta_fields',10,2);
function save_vacatures_meta_fields($vacatures_id, $vacatures){
   /*Check post type for vacatures*/
    if ( $vacatures->post_type == 'vacatures' ) {

		//Save Job description Start 
        if (isset( $_POST['vacatures_job_description'])) {
            update_post_meta($vacatures->ID, "vacatures_job_description", $_POST['vacatures_job_description']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_job_description");
        }
		// Job Description End 

		if (isset( $_POST['vacatures_job_we_ask'])) {
            update_post_meta($vacatures->ID, "vacatures_job_we_ask", $_POST['vacatures_job_we_ask']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_job_we_ask");
		}
		
		if (isset( $_POST['vacatures_job_we_offer'])) {
            update_post_meta($vacatures->ID, "vacatures_job_we_offer", $_POST['vacatures_job_we_offer']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_job_we_offer");
		}

		if (isset( $_POST['vacatures_other_job_info'])) {
            update_post_meta($vacatures->ID, "vacatures_other_job_info", $_POST['vacatures_other_job_info']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_other_job_info");
		}


		if (isset( $_POST['vacatures_job_email_address'])) {
            update_post_meta($vacatures->ID, "vacatures_job_email_address", $_POST['vacatures_job_email_address']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_job_email_address");
		}
		

		// save job date start
		if ( isset( $_POST['vacatures_add_job_date'])) {
            update_post_meta($vacatures->ID, "vacatures_add_job_date", $_POST['vacatures_add_job_date']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_add_job_date");
		}
		// Job date end
		
		// save amount of hours start
		if ( isset( $_POST['vacatures_amount_of_hours'])) {
            update_post_meta($vacatures->ID, "vacatures_amount_of_hours", $_POST['vacatures_amount_of_hours']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_amount_of_hours");
		}
		// save amount of hours end
		// Save Job type start 
		if ( isset( $_POST['vacatures_job_type'])) {
            update_post_meta($vacatures->ID, "vacatures_job_type", $_POST['vacatures_job_type']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_job_type");
		}
		// Job type end 

		// Amount of hours end 

        // save vacatures sub title
        if ( isset( $_POST['vacatures_sub_title'])) {
            update_post_meta($vacatures->ID, "vacatures_sub_title", $_POST['vacatures_sub_title']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_sub_title");
        }

         if ( isset( $_POST['vacatures_custom_url_redirect'])) {
            update_post_meta($vacatures->ID, "vacatures_custom_url_redirect", $_POST['vacatures_custom_url_redirect']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_custom_url_redirect");
        }

        
        // save vacatures author
        if ( isset( $_POST['author_select'])) {
            update_post_meta($vacatures->ID, "vacatures_author", $_POST['author_select']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_author");
        }        
        // save vacatures before after text
        if ( isset( $_POST['vacatures_before_after_text'])) {
            update_post_meta($vacatures->ID, "vacatures_before_after_text", $_POST['vacatures_before_after_text']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_before_after_text");
        }	        
        // save vacatures Client Name
        if ( isset( $_POST['vacatures_client_name'])) {
            update_post_meta($vacatures->ID, "vacatures_client_name", $_POST['vacatures_client_name']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_client_name");
        }
        // save vacatures Question / Solution
        if ( isset( $_POST['vacaturesquestionsolutionvalue'])) {
            update_post_meta($vacatures->ID, "vacaturesquestionsolutionvalue", $_POST['vacaturesquestionsolutionvalue']);
        }else{
            delete_post_meta($vacatures->ID, "vacaturesquestionsolutionvalue");
        }
        // save vacatures ratings
        if ( isset( $_POST['vacatures_rating'])) {
            update_post_meta($vacatures->ID, "vacatures_rating", $_POST['vacatures_rating']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_rating");
        }
        // save vacatures link
        if ( isset( $_POST['vacatures_link'])) {
            update_post_meta($vacatures->ID, "vacatures_link", $_POST['vacatures_link']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_link");
        }
          // save vacatures Intro
        if ( isset( $_POST['vacatures_intro'])) {
            update_post_meta($vacatures->ID, "vacatures_intro", $_POST['vacatures_intro']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_intro");
        }
        // save vacatures Location start
        if ( isset( $_POST['vacatures_location'])) {
            update_post_meta($vacatures->ID, "vacatures_location", $_POST['vacatures_location']);
        }else{
            delete_post_meta($vacatures->ID, "vacatures_location");
        }
        // save vacatures Location end
        // if ( isset( $_POST['vacatures_end_date'])) {
        //     update_post_meta($vacatures->ID, "vacatures_end_date", $_POST['vacatures_end_date']);
        // }else{
        //     delete_post_meta($vacatures->ID, "vacatures_end_date");
        // }
        // save vacatures Location
        // if ( isset( $_POST['vacatures_start_date'])) {
        //     update_post_meta($vacatures->ID, "vacatures_start_date", $_POST['vacatures_start_date']);
        // }else{
        //     delete_post_meta($vacatures->ID, "vacatures_start_date");
        // }
        // save vacatures Location
        if ( isset( $_POST['vacatures_active'])) {
            update_post_meta($vacatures->ID, "vacatures_active", "yes");
        }else{
            update_post_meta($vacatures->ID, "vacatures_active","no");
        }
        // save vacatures First Image(Image A)
        if(isset( $_POST['first_image_file'])){
	        $first_image_meta['first_image_file'] = $_POST['first_image_file'];
		    foreach($first_image_meta as $key => $value) {
		        if ($vacatures -> post_type == 'revision') return;
		        $value = implode(',', (array) $value);
		        if (get_post_meta($vacatures -> ID, $key, FALSE)) { // If the custom field already has a value it will update
		            update_post_meta($vacatures -> ID, $key, $value);
		        } else { // If the custom field doesn't have a value it will add
		            add_post_meta($vacatures -> ID, $key, $value);
		        }
		        if (!$value) delete_post_meta($vacatures -> ID, $key); // Delete if blank value
		    }
    	}
       
    	if (isset( $_POST['hhs_repeatable_meta_box_nonce'] ) ||
        wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce'], 'hhs_repeatable_meta_box_nonce' ) )
	    //return;
    	{
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!current_user_can('edit_post',$vacatures->ID)) return;
		$old = get_post_meta($vacatures->ID, 'repeatable_fields', true);
		$new = array();
		$options = get_profile_options_on_vacatures();
		$names = $_POST['name'];
		$selects = $_POST['select'];
		$urls = $_POST['url'];
		$count = count( $names );
		for ( $i = 0; $i < $count; $i++ ) {
			if ( $names[$i] != '' ) :
				$new[$i]['name'] = stripslashes( strip_tags( $names[$i] ) );
				
				if ( in_array( $selects[$i], $options ) )
					$new[$i]['select'] = $selects[$i];
				else
					$new[$i]['select'] = '';
			
				if ( $urls[$i] == 'http://' )
					$new[$i]['url'] = '';
				else
					$new[$i]['url'] = stripslashes( $urls[$i] ); // and however you want to sanitize
			endif;
		}
		if ( !empty( $new ) && $new != $old )
			update_post_meta($vacatures_id, 'repeatable_fields', $new );
		elseif ( empty($new) && $old )
			delete_post_meta($vacatures_id, 'repeatable_fields', $old );
        }
		/* Save Author Repeatable fields */
		
        // save vacatures Contacts
	   /*echo"<pre>";
	   var_dump($_POST['profile_contacts_repeatable_meta_box_nonce']);
	   echo"</pre>";
	   die;*/
    // save vacatures Contacts

    	if ( ! isset( $_POST['profile_contacts_repeatable_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['profile_contacts_repeatable_meta_box_nonce'], 'profile_contacts_repeatable_meta_box_nonce' ) )
				return;

			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
				return;

			if (!current_user_can('edit_post', $vacatures->ID))
				return;

			$old = get_post_meta($vacatures->ID, 'profile_contacts_repeatable_fields', true);
			/*var_dump($old);
			die;*/
			$new = array();
			$profile_options = get_profile_options_on_vacatures();
			$selectProfileContact = $_POST['selectProfileContact'];

			array_pop($selectProfileContact);
			//$urls = $_POST['url'];
			$count = count( $selectProfileContact );
			for ( $i = 0; $i < $count; $i++ ) {
				if ( $selectProfileContact[$i] != '' ) :
					//$new[$i]['selectProfileContact'] = stripslashes( strip_tags( $names[$i] ) );
					
					if ( in_array( $selectProfileContact[$i], $profile_options ) )
						$new[$i]['selectProfileContact'] = $selectProfileContact[$i];
					else
						$new[$i]['selectProfileContact'] = '';
				endif;
			}
			if ( !empty( $new ) && $new != $old)
				update_post_meta($vacatures_id, 'profile_contacts_repeatable_fields', $new );
			elseif ( empty($new) && $old )
				delete_post_meta($vacatures_id, 'profile_contacts_repeatable_fields', $old );			

    }		
}



?>


