var urlredirectValue = jQuery('#vacatures_custom_url_redirect').val();
	if (jQuery('#vacatures_custom_url_redirect').val().length == 0) {

		jQuery('#vacatures-subtitle').show();
		    jQuery('#vacatures-amount-of-hours').show();
		    jQuery('#vacatures-job-type').show();
		    jQuery('#vacatures-job-date-addition').show();
		    jQuery('#vacatures-job-description').show();
		    jQuery('#vacatures-job-we-ask').show();
		    jQuery('#vacatures-job-we-offer').show();
		    jQuery('#vacatures-other-job-info').show();
		    jQuery('#vacatures-apply-job-email-address').show();
		    jQuery('#vacatures-job-location').show();
		    jQuery('#vacatures-other-job-info').show();
		    jQuery('#vacatures-contacts').show();

	}else{

			jQuery('#vacatures-subtitle').hide();
		    jQuery('#vacatures-amount-of-hours').hide();
		    jQuery('#vacatures-job-type').hide();
		    jQuery('#vacatures-job-date-addition').hide();
		    jQuery('#vacatures-job-description').hide();
		    jQuery('#vacatures-job-we-ask').hide();
		    jQuery('#vacatures-job-we-offer').hide();
		    jQuery('#vacatures-other-job-info').hide();
		    jQuery('#vacatures-apply-job-email-address').hide();
		    jQuery('#vacatures-job-location').hide();
		    jQuery('#vacatures-other-job-info').hide();
		    jQuery('#vacatures-contacts').hide();

	}

	$('#vacatures_custom_url_redirect').keyup(function() {
		  // If value is not empty
		  if ($(this).val().length == 0) {
		    // Hide the element
		    $('#vacatures-subtitle').show();
		    $('#vacatures-amount-of-hours').show();
		    $('#vacatures-job-type').show();
		    $('#vacatures-job-date-addition').show();
		    $('#vacatures-job-description').show();
		    $('#vacatures-job-we-ask').show();
		    $('#vacatures-job-we-offer').show();
		    $('#vacatures-other-job-info').show();
		    $('#vacatures-apply-job-email-address').show();
		    $('#vacatures-job-location').show();
		    $('#vacatures-other-job-info').show();
		    $('#vacatures-contacts').show();
		  } else {
		    // Otherwise show it
		    $('#vacatures-subtitle').hide();
		    $('#vacatures-amount-of-hours').hide();
		    $('#vacatures-job-type').hide();
		    $('#vacatures-job-date-addition').hide();
		    $('#vacatures-job-description').hide();
		    $('#vacatures-job-we-ask').hide();
		    $('#vacatures-job-we-offer').hide();
		    $('#vacatures-other-job-info').hide();
		    $('#vacatures-apply-job-email-address').hide();
		    $('#vacatures-job-location').hide();
		    $('#vacatures-other-job-info').hide();
		    $('#vacatures-contacts').hide();
		    
		  }
	}).keyup(); // Trigger the keyup event, thus running the handler on page load