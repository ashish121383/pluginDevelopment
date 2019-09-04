<?php
add_action('init', 'register_vacatures');

	function register_vacatures() {
		$options = get_option( 'pp_vacatures_theme_options' );
		$vacatures_categories_st = $options['vacatures_categories_st'];
		$labels= array(
		        'name' => _x('Vacatures', 'post type general name'),
		        'singular_name' => _x('vacatures', 'post type singular name'),
		        'add_new' => _x('Nieuwe vacature', 'vacatures'),
		        'add_new_item' => __('Add New vacature'),
		        'edit_item' => __('Edit vacature'),
		        'new_item' => __('New vacature'),
		        'all_items' => __('Vacatures'),
		        'view_item' => __('View vacatures'),
		        'search_items' => __('Search vacatures'),
		        'not_found' => __('No vacatures found'),
		        'not_found_in_trash' => __('No vacatures found in the Trash'),
		        'parent_item_colon' => '',
		        'menu_name' => 'Vacatures'
		    );
		$args= array(
		        'labels' => $labels,
		        'description' => 'vacatures and vacatures related data will be hold in this',
		        'public' => true,
		        'menu_position' => 5,
		        'menu_icon' => 'dashicons-list-view',        
		        'supports' => array('title','post-format'),
		        'has_archive' => true,
		        'show_in_nav_menus' => true,
		        'show_ui' => true,
		        'taxonomies' => array('vacatures_category')  
		    );

		if($vacatures_categories_st == 'true'){
		    $labels_tax = array(
		        'name'     => _x( 'vacatures Category', 'Taxonomy General Name', 'text_domain' ),
		        'singular_name' => _x( 'vacatures Category', 'Taxonomy Singular Name', 'text_domain' ),
		        'menu_name' => __( 'Categorieën', 'text_domain' ),
		        'all_items' => __( 'Categorieën', 'text_domain' ),
		        'parent_item' => __( 'Parent Item', 'text_domain' ),
		        'parent_item_colon' => __( 'Parent Item:', 'text_domain' ),
		        'new_item_name' => __( 'New Category Name', 'text_domain' ),
		        'add_new_item' => __( 'Add New', 'text_domain' ),
		        'edit_item' => __( 'Edit Item', 'text_domain' ),
		        'update_item' => __( 'Update Item', 'text_domain' ),
		        'view_item' => __( 'View Item', 'text_domain' ),
		        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		        'add_or_remove_items' => __( 'Add or remove items', 'text_domain' ),
		        'choose_from_most_used' => __( 'Choose from the most used', 'text_domain' ),
		        'popular_items' => __( 'Popular Items', 'text_domain' ),
		        'search_items' => __( 'Search Items', 'text_domain' ),
		        'not_found'  => __( 'Not Found', 'text_domain' ),
		        'no_terms'  => __( 'No items', 'text_domain' ),
		        'items_list' => __( 'Items list', 'text_domain' ),
		        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		    );
			register_taxonomy(
			    'vacatures_category','vacatures',array(
			        'hierarchical'=>false,
			        'labels'=>$labels_tax,
			        'query_var'=>true,
			        'rewrite'=>true
			        )
			    );
		}

		 

		register_post_type('vacatures',$args);
	}


// function vacatures_post_type_tag_call_back() {
		
//      register_taxonomy_for_object_type('post_tag', 'vacatures');
// }
// add_action('init', 'vacatures_post_type_tag_call_back');
	
