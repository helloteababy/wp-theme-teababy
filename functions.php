<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


/* Remove Woocommerce footer credit */
add_action( 'init', 'custom_remove_footer_credit', 10 );

function custom_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    // add_action( 'storefront_footer', 'custom_storefront_credit', 20 );
} 

function custom_storefront_credit() {
    ?>
    <div class="site-info">
        Copyright &copy; <?php echo get_the_date( 'Y' ) . ' ' . get_bloginfo( 'name'); ?>. All Rights Reserved. Address: No.28 Dongpu Sanli, Xiamen 361004 China
		
        <br />

       <!-- Your custom message goes here -->

    </div><!-- .site-info -->
<?php
}

/* Edit required Checkout field */
// Hook in
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );

// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
     $address_fields['country']['required'] = true;
	 $address_fields['address_1']['required'] = true;
	 $address_fields['city']['required'] = true;
	 $address_fields['state']['required'] = true;
	 $address_fields['postcode']['required'] = true;

     return $address_fields;
}

// 关闭核心提示
add_filter('pre_site_transient_update_core',    create_function('$a', "return null;")); 

// "Best Sellers" Home products section
add_filter( 'storefront_best_selling_products_args', 'filter_storefront_best_selling_products_args', 10, 1 ); 
function filter_storefront_best_selling_products_args( $args ) {
    $args['orderby'] = 'rand'; // Random
    $args['limit'] = 12; // Total number of products presented
    $args['columns'] = 4;

    return $args;
}

// Custom Post Type for Bulletin Board
// Bulletin Board
function post_type_bulletin() {
register_post_type(
	'bulletin', 
	array( 'public' => true,
		'publicly_queryable' => true,
		'hierarchical' => false,
		'labels'=>array(
			'name' => _x('Bulletin', 'post type general name'),
			'singular_name' => _x('Bulletin', 'post type singular name'),
			'add_new' => _x('Add New', 'Bulletin'),
			'add_new_item' => __('Add New Bulletin'),
			'edit_item' => __('Edit Bulletin'),
			'new_item' => __('New Bulletin'),
			'view_item' => __('Preview Bulletin'),
			'search_items' => __('Search Bulletin'),
			'not_found' =>  __('No Bulletin Found'),
			'not_found_in_trash' => __('No Bulletin Found in Trash'), 
			'parent_item_colon' => ''
			),
		 'show_ui' => true,
		 'menu_position'=>5,
			'supports' => array(
			'title', 
			'revisions'	) ,
		'show_in_nav_menus'	=> true ,
		'taxonomies' => array(	
		    'menutype',
			'post_tag')
			) 
	); 
} 
add_action('init', 'post_type_bulletin');

function create_genre_taxonomy() {
  $labels = array(
		 'name' => _x( 'Taxonomy', 'taxonomy general name' ),
		 'singular_name' => _x( 'genre', 'taxonomy singular name' ),
		 'search_items' =>  __( 'Search Taxonomy' ),
		 'all_items' => __( 'All Taxonomy' ),
		 'parent_item' => __( 'Parent Taxonomy' ),
		 'parent_item_colon' => __( 'Parent Taxonomy Colon:' ),
		 'edit_item' => __( 'Edit Bulletin Taxonomy' ), 
		 'update_item' => __( 'Update Bulletin Taxonomy' ),
		 'add_new_item' => __( 'Add New Bulletin Taxonomy' ),
		 'new_item_name' => __( 'New Genre Name' ),
  ); 
  register_taxonomy('genre',array('bulletin'), array(
         'hierarchical' => true,
         'labels' => $labels,
         'show_ui' => true,
         'query_var' => true,
         'rewrite' => array( 'slug' => 'genre' ),
  ));
}
add_action( 'init', 'create_genre_taxonomy', 0 );

