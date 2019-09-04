<?php
if ( basename( $_SERVER['PHP_SELF'] ) == basename( __FILE__ ) ) {
    die( 'Sorry, but you cannot access this page directly.' );
}
add_action( 'init', 'pp_vacatures_do_output_buffer' );
add_action('admin_menu', 'pp_vacatures_setting_menu');
add_action( 'admin_head', 'pp_vacatures_admin_styles' );
add_action( 'admin_footer', 'pp_vacatures_admin_scripts' );
add_action( "load-theme-settings", 'pp_vacatures_save_options' );

function pp_vacatures_do_output_buffer() {
    ob_start();
    $settings = get_option( "pp_vacatures_theme_options" );
    if (empty($settings) ) {
        $settings['pp_vacatures_header_option_texts'] = '';
        $settings['pp_vacatures_header_option_values'] = '';
        add_option( "pp_vacatures_theme_options", $settings, '', 'yes' );
    }
}

function pp_vacatures_setting_menu(){
    $parent_slug ='edit.php?post_type=vacatures';
    $page_title ='Instellingen';
    $menu_title ='Instellingen';
    $capability ='manage_options';
    $menu_slug ='vacatures_options';
    $callback_function = 'pp_theme_vacatures_admin_options';
    add_submenu_page($parent_slug,$page_title,$menu_title,$capability,$menu_slug,$callback_function);        
    }

function pp_vacatures_admin_styles() {
    ?>
    <style type="text/css">
    .wrap table.vacatures_theme_options tr td{
        vertical-align:middle;
    }
    .wrap table.vacatures_theme_options tr td b{
        line-height:27px; 
        font-size:16px;
    }
    .wrap table.vacatures_theme_options tr td strong{
        color:#21759B;
    }
    .wrap table.vacatures_theme_options tr td label{
        cursor:pointer;
    }
    .wrap table.vacatures_theme_options thead tr td, .wrap table.vacatures_theme_options tfoot tr td{
        line-height:40px;
    }
    .wrap table.vacatures_theme_options tr td a.addnewrow, .wrap table.vacatures_theme_options tr td a.deleterow, .wrap table.vacatures_theme_options tr td a.sitebtn{
        background:url(<?php echo plugins_url();?>/pencilplus_vacatures/assets/images/add.png) no-repeat center center;
        height:20px;
        width:20px;
        display:inline-block;
        margin-left:5px;
        vertical-align:middle;
        background-size: cover;
     }
     .wrap table.vacatures_theme_options tr td a.sitebtn{
        background:url(<?php echo plugins_url();?>/pencilplus_vacatures/assets/images/image_add.png) no-repeat center center;
        background-size: cover;
     }
     .wrap table.vacatures_theme_options tr td a.deleterow{
        background:url(<?php echo plugins_url();?>/pencilplus_vacatures/assets/images/delete.png) no-repeat center center;
        background-size: cover;
     }
     </style>
    <?php
}

function pp_vacatures_admin_scripts() {
    ?>
    <script type="text/javascript">
    //<![CDATA[
        jQuery( document ).ready( function( e ){
            jQuery( ".vacatures_theme_options" ).delegate( ".addnewrow", "click", function(){
                var html = '<tr><td><label class="fleld_name">Field Name</label></td><td><select  name="pp_vacatures_header_option_values[]"><option value="">Select Layout Type</option><option value="list">List</option><option value="slider">Slider</option></select><a href="javascript:;" class="addnewrow"></a><a href="javascript:;" class="deleterow"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="description">Enter your own label name, please click on "Field Name" label.</span></td></tr>';
                var row = jQuery( this ).closest( 'tr' );
                var newRow = jQuery( html ).insertAfter( row );   
                newRow.find( '.deleterow' ).click( function() {
                    jQuery( this ).closest( 'tr' ).remove();
                });
            });
            jQuery( '.deleterow' ).click( function() {
                jQuery( this ).closest( 'tr' ).remove();
            });
            if(jQuery('.fleld_name').val() == ''){
            jQuery( ".vacatures_theme_options" ).delegate( "label.fleld_name", "click", function(){
                $text = jQuery( this ).html();
                jQuery( this ).replaceWith( '<input type="text" name="pp_vacatures_header_option_texts[]" value="' + $text + '" />' );
                console.log(jQuery( this ).closest( 'td' ).find( 'input').attr( 'class' ));
            });
        }
        });
    //]]>
    </script>
<?php
}

function pp_vacatures_save_options(){
    $vacatures_theme_options = get_option( "pp_vacatures_theme_options" );
    $vacatures_theme_options['pp_vacatures_header_option_texts'] = ($_POST['pp_vacatures_header_option_texts'] != '') ? $_POST['pp_vacatures_header_option_texts'] : $vacatures_theme_options['pp_vacatures_header_option_texts'];
    $vacatures_theme_options['pp_vacatures_header_option_values'] = ($_POST['pp_vacatures_header_option_values'] != '') ? $_POST['pp_vacatures_header_option_values'] : $vacatures_theme_options['pp_vacatures_header_option_values'];
    //$pp_vacatures_header_option_values = $_POST['pp_vacatures_header_option_values'];
    $vacatures_theme_options['vacatures_subtitle_st'] = ($_POST['vacatures_subtitle_st'] != '') ? $_POST['vacatures_subtitle_st'] : $_POST['vacatures_subtitle_st'];

     $vacatures_theme_options['vacatures_custom_url_redirect_st'] = ($_POST['vacatures_custom_url_redirect_st'] != '') ? $_POST['vacatures_custom_url_redirect_st'] : $_POST['vacatures_custom_url_redirect_st'];


     $vacatures_theme_options['vacatures_intro_st'] = ($_POST['vacatures_intro_st'] != '') ? $_POST['vacatures_intro_st'] : $_POST['vacatures_intro_st'];

    $vacatures_theme_options['vacatures_amount_of_hours_st'] = ($_POST['vacatures_amount_of_hours_st'] != '') ? $_POST['vacatures_amount_of_hours_st'] : $_POST['vacatures_amount_of_hours_st'];


    $vacatures_theme_options['vacatures_job_type_st'] = ($_POST['vacatures_job_type_st'] != '') ? $_POST['vacatures_job_type_st'] : $_POST['vacatures_job_type_st'];


    $vacatures_theme_options['vacatures_date_st'] = ($_POST['vacatures_date_st'] != '') ? $_POST['vacatures_date_st'] : $_POST['vacatures_date_st'];


    $vacatures_theme_options['vacatures_job_description_st'] = ($_POST['vacatures_job_description_st'] != '') ? $_POST['vacatures_job_description_st'] : $_POST['vacatures_job_description_st'];

    $vacatures_theme_options['vacatures_we_ask_st'] = ($_POST['vacatures_we_ask_st'] != '') ? $_POST['vacatures_we_ask_st'] : $_POST['vacatures_we_ask_st'];

    $vacatures_theme_options['vacatures_we_offer_st'] = ($_POST['vacatures_we_offer_st'] != '') ? $_POST['vacatures_we_offer_st'] : $_POST['vacatures_we_offer_st'];

    $vacatures_theme_options['vacatures_other_st'] = ($_POST['vacatures_other_st'] != '') ? $_POST['vacatures_other_st'] : $_POST['vacatures_other_st'];

    $vacatures_theme_options['vacatures_email_address_to_apply_st'] = ($_POST['vacatures_email_address_to_apply_st'] != '') ? $_POST['vacatures_email_address_to_apply_st'] : $_POST['vacatures_email_address_to_apply_st'];

    $vacatures_theme_options['vacatures_highlighted_picture_st'] = ($_POST['vacatures_highlighted_picture_st'] != '') ? $_POST['vacatures_highlighted_picture_st'] : $_POST['vacatures_highlighted_picture_st'];

    $vacatures_theme_options['vacatures_contact_st'] = ($_POST['vacatures_contact_st'] != '') ? $_POST['vacatures_contact_st'] : $_POST['vacatures_contact_st'];

    $vacatures_theme_options['vacatures_location_st'] = ($_POST['vacatures_location_st'] != '') ? $_POST['vacatures_location_st'] : $_POST['vacatures_location_st'];


    $vacatures_theme_options['vacatures_second_image_picture_st'] = ($_POST['vacatures_second_image_picture_st'] != '') ? $_POST['vacatures_second_image_picture_st'] : $_POST['vacatures_second_image_picture_st'];


    /* Create Custom filter option Start */
        $vacatures_theme_options['vacatures_list_st'] = ($_POST['vacatures_list_st'] != '') ? $_POST['vacatures_list_st'] : $_POST['vacatures_list_st'];

        $vacatures_theme_options['vacatures_list_filter_by_tag_st'] = ($_POST['vacatures_list_filter_by_tag_st'] != '') ? $_POST['vacatures_list_filter_by_tag_st'] : $_POST['vacatures_list_filter_by_tag_st'];

        $vacatures_theme_options['vacatures_slider_st'] = ($_POST['vacatures_slider_st'] != '') ? $_POST['vacatures_slider_st'] : $_POST['vacatures_slider_st'];

        $vacatures_theme_options['vacatures_slider_filter_by_tag_st'] = ($_POST['vacatures_slider_filter_by_tag_st'] != '') ? $_POST['vacatures_slider_filter_by_tag_st'] : $_POST['vacatures_slider_filter_by_tag_st'];

    $vacatures_theme_options['vacatures_categories_st'] = $_POST['vacatures_categories_st'] ? $_POST['vacatures_categories_st'] : '';

     $vacatures_theme_options['vacatures_custom_page_link'] = $_POST['vacatures_custom_page_link'] ? $_POST['vacatures_custom_page_link'] : '';

    //update_option('vacatures_sub_title_st', esc_html($vacatures_theme_options['vacatures_sub_title_st']));
    for( $i = 0; $i < count( $_POST['pp_vacatures_header_option_values'] ); $i++ ){
        $label_text = ($_POST['pp_vacatures_header_option_texts'][$i] != '' ) ? $_POST['pp_vacatures_header_option_texts'][$i] : '';
        $option_value = ($_POST['pp_vacatures_header_option_values'][$i] != '' ) ? $_POST['pp_vacatures_header_option_values'][$i] : '';
        if( !empty( $label_text ) && !empty( $option_value ) ){ 
            $labelname = strtolower( str_replace( " ", "_", $label_text ) );
            $vacatures_theme_options['pp_vacatures_header_option_values'][$labelname] = wp_filter_post_kses( $option_value );
        }
    }
    $updated = update_option( "pp_vacatures_theme_options", $vacatures_theme_options );
    wp_redirect( admin_url('edit.php?post_type=vacatures&page=vacatures_options&updated=true'));
    exit;
}

function pp_theme_vacatures_admin_options(){ 
    ?>
    <div class="wrap">
        <div id="icon-options-general" class="icon32"><br></div>
        <h2><?php _e( 'Custom vacatures Settings', 'pp_theme' );?></h2>
        <?php if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>Theme Settings updated.</p></div>'; ?>
            <form action="<?php admin_url( 'edit.php?post_type=vacatures&page=vacatures_options' ); ?>" method="post">
            <?php settings_fields( 'general' ); ?>
            <?php if( $_POST['save_settings'] == 'Y' ) { pp_vacatures_save_options(); }?>
            <?php 
            $options = get_option( 'pp_vacatures_theme_options' );
            //print_r($options);
            $vacatures_subtitle_st = ($options['vacatures_subtitle_st'] != '' ) ? $options['vacatures_subtitle_st'] : '';
            
             $vacatures_custom_url_redirect_st = ($options['vacatures_custom_url_redirect_st'] != '' ) ? $options['vacatures_custom_url_redirect_st'] : '';

            $vacatures_intro_st = ($options['vacatures_intro_st'] != '' ) ? $options['vacatures_intro_st'] : '';
            $vacatures_amount_of_hours_st = ($options['vacatures_amount_of_hours_st'] != '' ) ? $options['vacatures_amount_of_hours_st'] : '';
            $vacatures_job_type_st = ($options['vacatures_job_type_st'] != '' ) ? $options['vacatures_job_type_st'] : '';
            $vacatures_date_st = ($options['vacatures_date_st'] != '' ) ? $options['vacatures_date_st'] : '';
            $vacatures_job_description_st = ($options['vacatures_job_description_st'] != '' ) ? $options['vacatures_job_description_st'] : '';
            $vacatures_we_ask_st = ($options['vacatures_we_ask_st'] != '' ) ? $options['vacatures_we_ask_st'] : '';
            $vacatures_we_offer_st = ($options['vacatures_we_offer_st'] != '' ) ? $options['vacatures_we_offer_st'] : '';
            $vacatures_other_st = ($options['vacatures_other_st'] != '' ) ? $options['vacatures_other_st'] : '';

            $vacatures_email_address_to_apply_st = ($options['vacatures_email_address_to_apply_st'] != '' ) ? $options['vacatures_email_address_to_apply_st'] : '';
            $vacatures_highlighted_picture_st = ($options['vacatures_highlighted_picture_st'] != '' ) ? $options['vacatures_highlighted_picture_st'] : '';
            $vacatures_contact_st = ($options['vacatures_contact_st'] != '' ) ? $options['vacatures_contact_st'] : '';
            
            $vacatures_location_st = ($options['vacatures_location_st'] != '' ) ? $options['vacatures_location_st'] : '';

            $vacatures_second_image_picture_st = ($options['vacatures_second_image_picture_st'] != '' ) ? $options['vacatures_second_image_picture_st'] : '';

            // Custom Layout Option Start
            $vacatures_list_st = ($options['vacatures_list_st'] != '' ) ? $options['vacatures_list_st'] : '';
            $vacatures_list_filter_by_tag_st = ($options['vacatures_list_filter_by_tag_st'] != '' ) ? $options['vacatures_list_filter_by_tag_st'] : '';
            $vacatures_slider_st = ($options['vacatures_slider_st'] != '' ) ? $options['vacatures_slider_st'] : '';
            $vacatures_slider_filter_by_tag_st = ($options['vacatures_slider_filter_by_tag_st'] != '' ) ? $options['vacatures_slider_filter_by_tag_st'] : '';  

            $vacatures_categories_st = ($options['vacatures_categories_st'] != '' ) ? $options['vacatures_categories_st'] : '';

            $vacatures_custom_page_link = ($options['vacatures_custom_page_link'] != '' ) ? $options['vacatures_custom_page_link'] : '';                          

            ?>
            <p>&nbsp;</p>
            <table class="wp-list-table widefat vacatures_theme_options" cellspacing="0">
                <thead>
                    <tr>
                        <td style="width:20%"><b><?php _e( 'General Options', 'pp_theme' );?></b></td>
                        <td style="width:80%">&nbsp;</td>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td><!-- Show Categories -->
                        <?php if($vacatures_categories_st == 'true'){ ?>
                            <label class="label-container">Show Categories<input type="checkbox" name="vacatures_categories_st" value='true' checked /><span class="checkmark"></span></label>
                        <?php }else { ?>
                            <label class="label-container">Show Categories<input type="checkbox" name="vacatures_categories_st" value='true' /><span class="checkmark"></span></label>
                        <?php } ?>
                        </td>
                    </tr>

                    <!-- check Subtitle Start-->
                      <tr>
                        <td>
                          <?php if($vacatures_subtitle_st == 'true'){ ?>
                            <label class="label-container">Subtitel<input type="checkbox" name="vacatures_subtitle_st" value='true' checked /><span class="checkmark"></span></label>
                        <?php }else { ?>
                            <label class="label-container">Subtitel<input type="checkbox" name="vacatures_subtitle_st" value='true' /><span class="checkmark"></span></label>
                        <?php } ?>
                        </td>
                      </tr>  
                           

                       <tr>
                        <td>
                          <?php if($vacatures_custom_url_redirect_st == 'true'){ ?>
                            <label class="label-container">Url Redirect<input type="checkbox" name="vacatures_custom_url_redirect_st" value='true' checked /><span class="checkmark"></span></label>
                        <?php }else { ?>
                            <label class="label-container">Url Redirect<input type="checkbox" name="vacatures_custom_url_redirect_st" value='true' /><span class="checkmark"></span></label>
                        <?php } ?>
                        </td>
                      </tr>  

                      <!-- Check Subtitle End  -->
                      <!-- check Intro Start-->
                      <tr>
                        <td>
                            <?php if($vacatures_intro_st  == 'true' ) { ?>
                             <label class="label-container">Intro<input type="checkbox" name="vacatures_intro_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Intro<input type="checkbox" name="vacatures_intro_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>
                        </td>
                      </tr>            
                      <!-- Check Intro End  -->

                      <!-- Check Amount of hours Start-->
                      <tr>
                        <td>
                            <?php if($vacatures_amount_of_hours_st == 'true') { ?>
                             <label class="label-container">Aantal uren<input type="checkbox" name="vacatures_amount_of_hours_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Aantal uren<input type="checkbox" name="vacatures_amount_of_hours_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>
                        </td>
                      </tr>            
                      <!-- Check Amount of hours End  -->

                      <!-- check Job Type Start-->
                      <tr>
                        <td>
                            <?php if($vacatures_job_type_st == 'true') { ?>
                             <label class="label-container">Type dienstverband<input type="checkbox" name="vacatures_job_type_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Type dienstverband<input type="checkbox" name="vacatures_job_type_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>

                           
                        </td>
                      </tr>            
                      <!-- Check  Job Type End  -->
                      <!-- check Date Start-->
                      <tr>
                        <td>
                            <?php if($vacatures_date_st == 'true') { ?>
                             <label class="label-container">Datum<input type="checkbox" name="vacatures_date_st" value='true' checked /><span class="checkmark" checked></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Datum<input type="checkbox" name="vacatures_date_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>
                        </td>
                      </tr>            
                      <!-- Check Date End  -->

                      <!-- check Job Description Start-->
                      <tr>
                        <td>
                             <?php if($vacatures_job_description_st == 'true'
                           ) { ?>
                             <label class="label-container">Functieomschrijving<input type="checkbox" name="vacatures_job_description_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Functieomschrijving<input type="checkbox" name="vacatures_job_description_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>
                            
                        </td>
                      </tr>            
                      <!-- Check Job Description End  -->

                      <!-- check We Ask Start-->
                      <tr>
                        <td>
                           
                            <?php if($vacatures_we_ask_st) { ?>
                             <label class="label-container">Wij vragen<input type="checkbox" name="vacatures_we_ask_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Wij vragen<input type="checkbox" name="vacatures_we_ask_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>

                           
                        </td>
                      </tr>            
                      <!-- Check  We Ask End  -->

                      <!-- check We Offer Start-->
                      <tr>
                        <td>
                             
                            <?php if($vacatures_we_offer_st) { ?>
                             <label class="label-container">Wij bieden<input type="checkbox" name="vacatures_we_offer_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Wij bieden<input type="checkbox" name="vacatures_we_offer_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>

                          
                        </td>
                      </tr>            
                      <!-- Check  We Offer End  -->

                      <!-- check Other Start-->
                      <tr>
                        <td>

                            <?php if($vacatures_other_st) { ?>
                             <label class="label-container">Overig<input type="checkbox" name="vacatures_other_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Overig<input type="checkbox" name="vacatures_other_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>

                          
                        </td>
                      </tr>            
                      <!-- Check Other box  End  -->

                        <!-- check Email address to apply Start-->
                      <tr>
                        <td>
                            <?php if($vacatures_email_address_to_apply_st) { ?>
                             <label class="label-container">E-mailadres voor solliciteren<input type="checkbox" name="vacatures_email_address_to_apply_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">E-mailadres voor solliciteren<input type="checkbox" name="vacatures_email_address_to_apply_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>
                        </td>
                      </tr>            
                      <!-- check Email address to apply End-->

                        <!-- check Highlighted picture Start-->
                      <tr>
                        <td>
                             <?php if($vacatures_highlighted_picture_st) { ?>
                             <label class="label-container">Uitgelichte afbeelding<input type="checkbox" name="vacatures_highlighted_picture_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Uitgelichte afbeelding<input type="checkbox" name="vacatures_highlighted_picture_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>
                           
                        </td>
                      </tr>            
                      <!-- Check Highlighted picture End  -->

                        <!-- check Contact Person Start-->
                      <tr>
                        <td>
                            <?php if($vacatures_contact_st) { ?>
                             <label class="label-container">Contactpersoon<input type="checkbox" name="vacatures_contact_st" value='true' checked/><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Contactpersoon<input type="checkbox" name="vacatures_contact_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>
                        </td>
                      </tr>            
                      <!-- Check Contact Person End  -->
                      <!-- check Location Start-->
                      <tr>
                        <td>
                             <?php if($vacatures_location_st) { ?>
                             <label class="label-container">Locatie<input type="checkbox" name="vacatures_location_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Locatie<input type="checkbox" name="vacatures_location_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>

                        </td>
                      </tr>            
                      <!-- Check Location End  -->

                        <!-- check Second Image Start-->
                      <tr>
                        <td>
                              <?php if($vacatures_second_image_picture_st) { ?>
                             <label class="label-container">Afbeelding<input type="checkbox" name="vacatures_second_image_picture_st" value='true' checked /><span class="checkmark"></span></label>   
                             <?php }else{ ?>   
                            <label class="label-container">Afbeelding<input type="checkbox" name="vacatures_second_image_picture_st" value='true' /><span class="checkmark"></span></label>
                            <?php } ?>
                        </td>
                      </tr>            
                      <!-- check Second Image End-->

                    <thead>
                        <tr>
                            <td style="width:20%"><b><?php _e( 'Layouts', 'pp_theme' );?></b></td>
                            <td style="width:80%">&nbsp;</td>
                        </tr>
                    </thead>
                <?php 
                    $id = 0;
                    if( !empty( $options['pp_vacatures_header_option_texts'] ) && !empty( $options['pp_vacatures_header_option_values'] ) ) {
                        $count = count( $options['pp_vacatures_header_option_values'] );
                        for( $i = 0; $i < $count; $i++ ) {
                        $id++;  
                            $label_text = ($options['pp_vacatures_header_option_texts'][$i] != '') ? $options['pp_vacatures_header_option_texts'][$i] : '';
                            $labelname = strtolower(str_replace( " ", "_", $label_text ));
                            $option_value = ($options['pp_vacatures_header_option_values'][$labelname] != '') ? $options['pp_vacatures_header_option_values'][$labelname] : '';
                            if(!empty( $label_text ) && !empty( $option_value )){ 
                                ?>
                                <tr>
                                    <td>
                                        <label id="<?php echo $id;?>" class="fleld_name"><?php echo $label_text;?></label>
                                        <input id="<?php echo $id;?>" type="hidden" value="<?php echo $label_text;?>" name="pp_vacatures_header_option_texts[]" />
                                    </td>
                                    <td>
                                        <?php //echo $option_value; ?>
                                        <select name="pp_vacatures_header_option_values[]">
                                            <option value="">Select Layout Type</option>
                                            <option value="list"<?php if($option_value=="list") echo "selected";?>>List</option>
                                            <option value="slider"<?php if($option_value=="slider") echo "selected";?>>Slider</option>
                                        </select><a href="javascript:;" class="addnewrow"></a><a href="javascript:;" class="deleterow"></a></td>
                                </tr>
                            <?php } ?>
                        <?php  } ?>
                    <?php } else { ?>
                    <tr>
                        <td>
                            <label id="<?php echo $label_text;?>" class="fleld_name"><?php _e( 'Field Name', 'pp_theme' );?></label>
                        </td>
                        <td>
                            <select name="pp_vacatures_header_option_values[]">  
                                <option value="">Select Layout Type</option>
                                <option value="list">List</option>
                                <option value="slider">Slider</option>
                            </select>
                        </td>
                    </tr>
                    <?php } ?>

                      <thead>
                        <tr>
                            <td style="width:20%"><b><?php _e( 'Vacature overzichtspagina', 'pp_theme' );?></b></td>
                            <td style="width:80%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                 <label id="<?php echo 'custom-page-link';?>" class="fleld_name"><?php _e( 'Link voor overzichtspagina', 'pp_theme' );?></label>

                                <?php if($vacatures_custom_page_link){ ?>

                                  <input id="<?php echo 'custom-page-link';?>" type="text" value="<?php echo $vacatures_custom_page_link; ?>" name="vacatures_custom_page_link" />

                                <?php }else{ ?>
                                    
                                  <input id="<?php echo 'custom-page-link';?>" type="text" value="" name="vacatures_custom_page_link" />                                          

                              <?php } ?>
                            </td>
                        </tr>    

                    </thead>

                </tbody>
            </table>
            <p class="submit">
                <input type="submit" value="Save Changes" class="button button-primary" id="submit" name="submit">
                <input type="hidden" value="Y" name="save_settings" />
                <input type="hidden" name="page_options" value="vacatures_sub_title_st"/>
            </p>
        </form>



    </div>
<?php } ?>