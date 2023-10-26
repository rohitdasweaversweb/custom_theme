<?php

/*****************************************
* Weaver's Web Functions & Definitions *
*****************************************/
$functions_path = get_template_directory().'/functions/';
// $post_type_path = get_template_directory().'/inc/post-types/';
/*--------------------------------------*/
/* Optional Panel Helper Functions
/*--------------------------------------*/
require_once($functions_path.'admin-functions.php');
require_once($functions_path.'admin-interface.php');
require_once($functions_path.'theme-options.php');
function weaversweb_ftn_wp_enqueue_scripts(){
    if(!is_admin()){
        wp_enqueue_script('jquery');
        if(is_singular()and get_site_option('thread_comments')){
            wp_print_scripts('comment-reply');
			}
		}
	}
add_action('wp_enqueue_scripts','weaversweb_ftn_wp_enqueue_scripts');
function weaversweb_ftn_get_option($name){
    $options = get_option('weaversweb_ftn_options');
    if(isset($options[$name]))
        return $options[$name];
	}
function weaversweb_ftn_update_option($name, $value){
    $options = get_option('weaversweb_ftn_options');
    $options[$name] = $value;
    return update_option('weaversweb_ftn_options', $options);
	}
function weaversweb_ftn_delete_option($name){
    $options = get_option('weaversweb_ftn_options');
    unset($options[$name]);
    return update_option('weaversweb_ftn_options', $options);
	}
function get_theme_value($field){
	$field1 = weaversweb_ftn_get_option($field);
	if(!empty($field1)){
		$field_val = $field1;

		}
	return	$field_val;
	}
/*--------------------------------------*/
/* Post Type Helper Functions
/*--------------------------------------*/

// require_once($post_type_path.'testimonials.php');
// require_once($post_type_path.'teams.php');
// require_once($post_type_path.'projects.php');
// require_once($post_type_path.'perks.php');

/*--------------------------------------*/
/* Theme Helper Functions
/*--------------------------------------*/
if(!function_exists('weaversweb_theme_setup')):
	function weaversweb_theme_setup(){
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		register_nav_menus(array(
			'primary' => __('Primary Menu','weaversweb'),
			'secondary'  => __('Secondary Menu','weaversweb'),
			'other' => __('other Menu','weaversweb'),

			));

		add_theme_support('html5',array('search-form','comment-form','comment-list','gallery','caption'));
		}
	endif;
add_action('after_setup_theme','weaversweb_theme_setup');
function weaversweb_widgets_init(){
	register_sidebar(array(
		'name'          => __('Widget Area','weaversweb'),

		'id'            => 'sidebar-1',

		'description'   => __('Add widgets here to appear in your sidebar.','weaversweb'),

		'before_widget' => '<div id="%1$s" class="widget %2$s">',

		'after_widget'  => '</div>',

		'before_title'  => '<h2 class="widget-title">',

		'after_title'   => '</h2>',
		));

	}
add_action('widgets_init','weaversweb_widgets_init');




function weaversweb_scripts(){
	wp_enqueue_style('animate.min.css',get_template_directory_uri().'/assets/css/animate.min.css',array());

	wp_enqueue_style('bootstrap.min.css',get_template_directory_uri().'/assets/css/bootstrap.min.css',array());

	wp_enqueue_style('bootstrap-grid.min.css',get_template_directory_uri().'/assets/css/bootstrap-grid.min.css',array());

	wp_enqueue_style('font-awesome-all.min.css',get_template_directory_uri().'/assets/css/font-awesome-all.min.css',array());


	wp_enqueue_style('owl.carousel.min.css',get_template_directory_uri().'/assets/css/owl.carousel.min.css',array());
	
	wp_enqueue_style('owl.theme.default.min.css',get_template_directory_uri().'/assets/css/owl.theme.default.min.css',array());

   	wp_enqueue_style('custom.css',get_template_directory_uri().'/assets/css/custom.css',array());
	// Load the Internet Explorer specific script.

	global $wp_scripts;

    wp_enqueue_script('bootstrap.bundle.min.js',get_template_directory_uri().'/assets/js/bootstrap.bundle.min.js',array('jquery'),time(),true);

	wp_enqueue_script('bootstrap.min.js',get_template_directory_uri().'/assets/js/bootstrap.min.js',array('jquery'),time(),true);


	wp_enqueue_script('font-awesome-all.min.js',get_template_directory_uri().'/assets/js/font-awesome-all.min.js',array('jquery'),time(),true);

	wp_enqueue_script('owl.carousel.min.js',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),time(),true);

	wp_enqueue_script('wow.min.js',get_template_directory_uri().'/assets/js/wow.min.js',array('jquery'),time(),true);

	// wp_enqueue_script('jquery.js',get_template_directory_uri().'/assets/js/jquery.min.js',array('jquery'),time(),true);

	wp_register_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array(), 1, 1, 1);
	wp_enqueue_script('custom');
	wp_localize_script('custom', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

    
	}
add_action('wp_enqueue_scripts','weaversweb_scripts');
add_action('wp_head','hook_javascript');
function hook_javascript() {
?>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php')  ?>";
</script>
<?php 
}


// Body Class

// add_theme_support("woocommerce");
function mytheme_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'mytheme_add_woocommerce_support');
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns()
	{
		return 3; // 3 products per row
	}
}


// =====================remove breadcrumb=================

add_filter('woocommerce_before_main_content', 'remove_breadcrumbs');
function remove_breadcrumbs()
{
	if (!is_product()) {
		remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
	}
}

// ===============================remove titlte=================
add_filter('woocommerce_show_page_title', 'bbloomer_hide_shop_page_title');

function bbloomer_hide_shop_page_title($title)
{
	if (is_shop())
		$title = false;
	return $title;
}

// ===============================remove result_count=================

add_action('after_setup_theme', function () {
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	remove_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);
});

// ===============================remove catalog_ordering',=================

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


////////////////////////Sidebar Remove from Single page///////////////////
add_action('wp', 'my_remove_sidebar_product_pages');

function my_remove_sidebar_product_pages()
{

	if (is_product()) {

		remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

	}

}

// ======================================search==================================

add_action('wp_ajax_product_search_callback', 'product_search_callback');
add_action('wp_ajax_nopriv_product_search_callback', 'product_search_callback');

function product_search_callback() {
    $product_name = $_POST['search_query'];
	//  print_r($product_name);die();

    // Query the WooCommerce products based on the product name
    $args = array(
        'post_type' => 'product',
        // 'posts_per_page' => -1,
        's' =>  esc_attr( $product_name),
    );

    $products = new WP_Query($args);
	if ($products->have_posts()) {?>
	 
	<?php
		while ($products->have_posts()) {
			$products->the_post();
			$product = wc_get_product($products->post->ID);
	?>
			<div class="col-lg-4 col-md-6">
				<div class="shop-gallery-col">
					<div class="shop-gallery-img-wrap">
						<?php
						if (has_post_thumbnail())
							echo get_the_post_thumbnail($products->post->ID, 'shop_catalog');
						else
							echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" />';
						?>
					</div>
					<div class="shop-gallery-content">
						<h4><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h4>
						<p>Price: <?php echo $product->get_price_html(); ?></p>
					</div>
				</div>
			</div>
	<?php
		}
		?>
			
		
		<?php
	} else {
		echo '<h2>No products found.</h2>';
	}
	

    die();
}


// =======================================
add_filter( 'wc_add_to_cart_message_html', '__return_false' );

// ====================================================================
	// Replace 'your_custom_post_type' with the name of your custom post type.
// function add_pdf_url_field_to_post($post_id) {
//     if (get_post_type($post_id) === 'pdf') {
//         // Change 'pdf_url' to the name of your custom field.
//         add_post_meta($post_id, 'pdf_url', '', true);
//     }
// }
// add_action('save_post', 'add_pdf_url_field_to_post');


// ==================================================
// Add a custom meta box for PDF URL
function add_pdf_url_meta_box() {
    add_meta_box('pdf-url-meta-box', 'PDF URL', 'render_pdf_url_meta_box', 'pdf', 'normal', 'default');
}
add_action('add_meta_boxes', 'add_pdf_url_meta_box');



// Render the input field for PDF URL in the meta box
function render_pdf_url_meta_box($post) {
    $pdf_url = get_post_meta($post->ID, 'pdf_url', true);
    ?>
    <label for="pdf_url">PDF URL:</label>
    <input type="text" id="pdf_url" name="pdf_url" value="<?php echo esc_attr($pdf_url); ?>" style="width: 100%;">
    <?php
}





// Save PDF URL data when the post is updated
function save_pdf_url_data($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['pdf_url'])) {
        update_post_meta($post_id, 'pdf_url', sanitize_text_field($_POST['pdf_url']));
    }
}
add_action('save_post', 'save_pdf_url_data');

// ================================================================================