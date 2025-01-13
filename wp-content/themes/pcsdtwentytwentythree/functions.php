<?php
$theme_version = '2.0.1';
/*==========================================================================================
Theme Setup
============================================================================================*/
function pcsd_assets()
{
	global $theme_version;
	//register different script files
	wp_register_script('mainScripts', get_template_directory_uri() . '/assets/js/main_scripts.js', array('jquery', 'slickScripts'), $theme_version, true);
	wp_register_script('cludoScripts', 'https://customer.cludo.com/scripts/bundles/search-script.min.js', '', '1.0.1', true);
	wp_register_script('slickScripts', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.0.1', true);
	wp_register_script('linkDetection', get_template_directory_uri() . '/assets/js/linkDetection.js', '', $theme_version, true);
	wp_register_script('404easterEgg', get_template_directory_uri() . '/assets/js/404.js', '', $theme_version, true);
	wp_register_script('formfix', get_template_directory_uri() . '/assets/js/formfix.js', '', $theme_version, true);

	//load CSS files
	wp_enqueue_style('variables', get_template_directory_uri() . '/assets/css/variables.css', '', $theme_version, false);
	wp_enqueue_style('reset', get_template_directory_uri() . '/assets/css/reset.css', '', $theme_version, false);
	wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', '', $theme_version, false);
	wp_enqueue_style('fonts', get_template_directory_uri() . '/assets/css/font.css', '', $theme_version, false);
	wp_enqueue_style('header', get_template_directory_uri() . '/assets/css/header.css', '', $theme_version, false);
	wp_enqueue_style('breadcrumbs', get_template_directory_uri() . '/assets/css/breadcrumbs.css', '', $theme_version, false);
	wp_enqueue_style('footer', get_template_directory_uri() . '/assets/css/footer.css', '', $theme_version, false);
	wp_enqueue_style('sidebar', get_template_directory_uri() . '/assets/css/sidebar.css', '', $theme_version, false);
	wp_enqueue_style('cludo_css', 'https://customer.cludo.com/css/templates/v2.1/essentials/cludo-search.min.css', '', '2.1', false);
	wp_enqueue_style('slick_css', get_template_directory_uri() . '/assets/css/slick.css', '', '1.0', false);
	wp_enqueue_style('linkmarking', get_template_directory_uri() . '/assets/css/linkmarking.css', '', $theme_version, false);
	wp_enqueue_style('printing', get_template_directory_uri() . '/assets/css/print.css', '', $theme_version, false);

	//load js files
	wp_enqueue_script('slickScripts');
	wp_enqueue_script('cludoScripts');
	wp_enqueue_script('linkDetection');
	wp_enqueue_script('mainScripts');

	if (is_front_page()) {
		wp_enqueue_style('front_page', get_template_directory_uri() . '/assets/css/frontpage.css', array(), $theme_version, false);
	}

	if (is_page_template(
		array(
			'template-department_2022.php',
			'template-department_2022_links.php',
			'template-department_2022-tiles-news.php',
			'template-department-staticmedia.php',
			'template-department_fulltileimages.php',
			'template-department-tile-full-width.php',
			'template-department_2022_no_top_menu.php',
		)
	)) {
		wp_enqueue_style('department', get_template_directory_uri() . '/assets/css/department-styles.css', '', $theme_version, false);
		wp_enqueue_style('tiles', get_template_directory_uri() . '/assets/css/tiles.css', '', $theme_version, false);
	}

	//load legacy style sheet on selected templates
	if (is_page_template(
		array(
			'template-department_default.php',
			'template-childNutrition-tiles.php',
			'template-ChildNutrition-page.php',
			'template-tile-noSlider.php',
			'template-department-staticmedia.php',
			'template-department_fulltileimages.php',
			'template-department_repeater_slider.php',

		)
	)) {
		wp_enqueue_style('legacy', get_template_directory_uri() . '/assets/css/legacy-styles.css', '', $theme_version, false);
	}

	if (is_404()) {
		wp_enqueue_script('404easterEgg');
	}

	if (is_page(array(4026, 18049))) {
		wp_enqueue_script('formfix');
	}

	if (is_page_template(array('template-school-listing.php'))) {
		wp_enqueue_style('school-demo', get_template_directory_uri() . '/assets/css/school-demographics.css', '', $theme_version, false);
	}
}
add_action('wp_enqueue_scripts', 'pcsd_assets', 9999);

//function to check for single custom tempaltes.
add_filter('template_include', 'var_template_include', 1000);
function var_template_include($t)
{
	$GLOBALS['current_theme_template'] = basename($t);
	return $t;
}

function get_current_template($echo = false)
{
	if (!isset($GLOBALS['current_theme_template']))
		return false;
	if ($echo)
		echo $GLOBALS['current_theme_template'];
	else
		return $GLOBALS['current_theme_template'];
}


// Remove type from scripts and styles
add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
function codeless_remove_type_attr($tag, $handle)
{
	return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
}
// Enable Featured Images
add_theme_support('post-thumbnails');

// Add Menu Support
add_theme_support('menus');


// Wordpress Menus Registration

register_nav_menus(
	array(
		'header-menu' => __('Header Menu'),
		'frontpage-categories' => __('Front Page Categories')
	)
);

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
/*==========================================================================================
// Favicon
============================================================================================*/
function pcsd_add_favicon()
{ ?>
	<!-- Custom Favicons -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/safari-pinned-tab.svg">
<?php }
//add the favicon link to the live site head
add_action('wp_head', 'pcsd_add_favicon');
//add the favicon to the login page
add_action('login_head', 'pcsd_add_favicon');
/*==========================================================================================
// custom Login Page
============================================================================================*/
function my_custom_login()
{
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

function my_login_logo_url()
{
	return get_bloginfo('url');
}
add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title()
{
	return 'Provo City School District';
}
add_filter('login_headertitle', 'my_login_logo_url_title');

/*==========================================================================================
block WordPress User Enumeration Scans
============================================================================================*/
if (!is_admin()) {
	// default URL format
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
	add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2);
}
function shapeSpace_check_enum($redirect, $request)
{
	// permalink URL format
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
	else return $redirect;
}
/*==========================================================================================
Display Modified Date on Dashboard for Posts
============================================================================================*/
// Register Modified Date Column for both posts & pages
function modified_column_register($columns)
{
	$columns['Modified'] = __('Modified Date', 'show_modified_date_in_admin_lists');
	return $columns;
}
add_filter('manage_posts_columns', 'modified_column_register');
add_filter('manage_pages_columns', 'modified_column_register');

function modified_column_display($column_name, $post_id)
{
	switch ($column_name) {
		case 'Modified':
			global $post;
			echo '<p class="mod-date">';
			echo '<em>' . get_the_modified_date() . ' ' . get_the_modified_time() . '</em><br />';
			echo '<small>' . esc_html__('by ', 'show_modified_date_in_admin_lists') . '<strong>' . get_the_modified_author() . '<strong></small>';
			echo '</p>';
			break; // end all case breaks
	}
}
add_action('manage_posts_custom_column', 'modified_column_display', 10, 2);
add_action('manage_pages_custom_column', 'modified_column_display', 10, 2);

function modified_column_register_sortable($columns)
{
	$columns['Modified'] = 'modified';
	return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'modified_column_register_sortable');
add_filter('manage_edit-page_sortable_columns', 'modified_column_register_sortable');

//[directory url=""]

function directory_func($atts)
{
	$category = shortcode_atts(array(
		'url' => 'something',
	), $atts);
	$directory_url = "{$category['url']}";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $directory_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	// TODO: to verify certificate, but path to cerificate may move or change in the future. want to think through something so this doesn't get disjointed or forgotten, going to not verify for now
	// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	// curl_setopt($ch, CURLOPT_CAINFO, '/etc/ssl/wildcard/star_provo_edu.crt'); // Path to CA certificates bundle
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$output = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	return $output;
}
add_shortcode('directory', 'directory_func');

//[frontpage_categories]
function frontpage_categories_menu()
{
	ob_start();
	echo '<div class="categories-6h">';
	wp_nav_menu(array('menu' => 'frontpage-categories'));
	echo '</div>';
	return ob_get_clean();
}
add_shortcode('frontpage_categories', 'frontpage_categories_menu');

/*==========================================================================================
Add Length Column to the Wordpress Dashboard
============================================================================================*/

//For Posts

//Add the Length column, next to the Title column:

add_filter('manage_post_posts_columns', function ($columns) {
	$_columns = [];

	foreach ((array) $columns as $key => $label) {
		$_columns[$key] = $label;
		if ('title' === $key)
			$_columns['wpse_post_content_length'] = __('Length');
	}
	return $_columns;
});

//Fill that column with the post content length values:

add_action('manage_post_posts_custom_column', function ($column_name, $post_id) {
	if ($column_name == 'wpse_post_content_length')
		echo mb_strlen(get_post($post_id)->post_content);
}, 10, 2);

//Make our Length column orderable:

add_filter('manage_edit-post_sortable_columns', function ($columns) {
	$columns['wpse_post_content_length'] = 'wpse_post_content_length';
	return $columns;
});
//Finally we implement the ordering through the posts_orderby filter:

add_filter('posts_orderby', function ($orderby, \WP_Query $q) {
	$_orderby = $q->get('orderby');
	$_order   = $q->get('order');

	if (
		is_admin()
		&& $q->is_main_query()
		&& 'wpse_post_content_length' === $_orderby
		&& in_array(strtolower($_order), ['asc', 'desc'])
	) {
		global $wpdb;
		$orderby = " LENGTH( {$wpdb->posts}.post_content ) " . $_order . " ";
	}
	return $orderby;
}, 10, 2);

//For Pages

//Add the Length column, next to the Title column:

add_filter('manage_page_posts_columns', function ($columns) {
	$_columns = [];

	foreach ((array) $columns as $key => $label) {
		$_columns[$key] = $label;
		if ('title' === $key)
			$_columns['wpse_post_content_length'] = __('Length');
	}
	return $_columns;
});

//Fill that column with the post content length values:

add_action('manage_page_posts_custom_column', function ($column_name, $post_id) {
	if ($column_name == 'wpse_post_content_length')
		echo mb_strlen(get_post($post_id)->post_content);
}, 10, 2);

//Make our Length column orderable:

add_filter('manage_edit-page_sortable_columns', function ($columns) {
	$columns['wpse_post_content_length'] = 'wpse_post_content_length';
	return $columns;
});
//Finally we implement the ordering through the posts_orderby filter:

add_filter('posts_orderby', function ($orderby, \WP_Query $q) {
	$_orderby = $q->get('orderby');
	$_order   = $q->get('order');

	if (
		is_admin()
		&& $q->is_main_query()
		&& 'wpse_post_content_length' === $_orderby
		&& in_array(strtolower($_order), ['asc', 'desc'])
	) {
		global $wpdb;
		$orderby = " LENGTH( {$wpdb->posts}.post_content ) " . $_order . " ";
	}
	return $orderby;
}, 10, 2);
//Notes

//If you want to target other post types, than we just have to modify the

//manage_post_posts_columns         -> manage_{POST_TYPE}_posts_columns
//manage_post_posts_custom_column   -> manage_{POST_TYPE}_posts_custom_column
//manage_edit-post_sortable_columns -> manage_edit-{POST_TYPE}_sortable_columns

//where POST_TYPE is the wanted post type.

/*==========================================================================================
add email column to Directory post type
stack thread -> https://stackoverflow.com/questions/54581263/sortable-custom-column-using-acf-pro-select-field-in-wordpress-admin-for-post-li/70628121#70628121
============================================================================================*/

add_filter('manage_directory_posts_columns', 'filter_directory_custom_columns');

function filter_directory_custom_columns($columns)
{
	$columns['email'] = 'Email';
	return $columns;
}

add_action('manage_directory_posts_custom_column',  'action_directory_custom_columns');

function action_directory_custom_columns($column)
{
	global $post;
	if ($column == 'email') {
		$directoryfields = get_fields($post->ID);
		echo $directoryfields['email'];
	}
}

add_filter('manage_edit-directory_sortable_columns', 'sortable_directory_custom_columns');

function sortable_directory_custom_columns($columns)
{
	$columns['email'] = 'email';
	return $columns;
}
add_action('pre_get_posts', 'directory_orderby');
function directory_orderby($query)
{
	if (!is_admin())
		return;
	$orderby = $query->get('orderby');
	if ('email' == $orderby) {
		$query->set('meta_key', 'email');
		$query->set('orderby', 'meta_value');
	}
}

/*==========================================================================================
Custom Post Types
============================================================================================*/
function cptui_register_my_cpts_announcement()
{

	/**
	 * Post Type: Announcements.
	 */

	$labels = [
		"name" => __("Announcements", "custom-post-type-ui"),
		"singular_name" => __("Announcement", "custom-post-type-ui"),
		"menu_name" => __("Announcements", "custom-post-type-ui"),
		"all_items" => __("All Announcements", "custom-post-type-ui"),
		"add_new" => __("Add Announcement", "custom-post-type-ui"),
	];

	$args = [
		"label" => __("Announcements", "custom-post-type-ui"),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => ["slug" => "announcement", "with_front" => true],
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "https://globalassets.provo.edu/image/icons/pcsd-icon-16x16.png",
		"supports" => ["title", "editor", "thumbnail"],
		"show_in_graphql" => false,
	];

	register_post_type("announcement", $args);
}

add_action('init', 'cptui_register_my_cpts_announcement');

function cptui_register_my_cpts()
{
	/**
	 * Post Type: Directory Pages.
	 */

	$labels = [
		"name" => __("Directory Pages", "custom-post-type-ui"),
		"singular_name" => __("Directory Page", "custom-post-type-ui"),
	];

	$args = [
		"label" => __("Directory Pages", "custom-post-type-ui"),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => ["slug" => "directory_page", "with_front" => true],
		"query_var" => true,
		"menu_position" => 7,
		"menu_icon" => "https://globalassets.provo.edu/image/icons/pcsd-icon-16x16.png",
		"supports" => ["title", "thumbnail", "page-attributes"],
	];

	register_post_type("directory_page", $args);

	/**
	 * Post Type: Directory.
	 */

	$labels = [
		"name" => __("Directory", "custom-post-type-ui"),
		"singular_name" => __("Directory", "custom-post-type-ui"),
		"featured_image" => __("Staff Photo", "custom-post-type-ui"),
		"set_featured_image" => __("Set Staff Photo", "custom-post-type-ui"),
		"remove_featured_image" => __("Remove Staff Photo", "custom-post-type-ui"),
	];

	$args = [
		"label" => __("Directory", "custom-post-type-ui"),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => ["slug" => "directory", "with_front" => true],
		"query_var" => true,
		"menu_position" => 6,
		"menu_icon" => "https://globalassets.provo.edu/image/icons/pcsd-icon-16x16.png",
		"supports" => ["title", "thumbnail"],
	];

	register_post_type("directory", $args);

	/**
	 * Post Type: Internship Locations
	 */

	$labels = [
		"name" => __("Internship Locations", "custom-post-type-ui"),
		"singular_name" => __("Internship Locations", "custom-post-type-ui"),
	];

	$args = [
		"label" => __("Internship Locations", "custom-post-type-ui"),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => ["slug" => "internship_locations", "with_front" => true],
		"query_var" => true,
		"menu_icon" => "https://globalassets.provo.edu/image/icons/pcsd-icon-16x16.png",
		"supports" => ["title"],
	];

	register_post_type("internship_locations", $args);


	/**
	 * Post Type: Digital Signage.
	 */

	$labels = [
		"name" => __("Digital Signage", "sunset-child"),
		"singular_name" => __("Digital Signage", "sunset-child"),
	];

	$args = [
		"label" => __("Digital Signage", "sunset-child"),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => ["slug" => "digital_signage", "with_front" => true],
		"query_var" => true,
		"menu_icon" => "https://globalassets.provo.edu/image/icons/pcsd-icon-16x16.png",
		"supports" => ["title"],
	];

	register_post_type("digital_signage", $args);
}

add_action('init', 'cptui_register_my_cpts');



//add ID column to Directory Categories
add_filter("manage_edit-directory_category_columns",          	'my_add_col');
add_filter("manage_edit-directory_category_sortable_columns", 	'my_add_col');
add_filter("manage_directory_category_custom_column",         	'my_tax_id', 10, 3);


function my_add_col($new_columns)
{
	$new_columns = array(
		'cb' => '<input type="checkbox" />',
		'name'   => __('Name'),
		'tax_id' => 'ID',
		'slug'   => __('Slug'),
		'posts'  => __('Posts')

	);

	return $new_columns;
}
//propagate the Tax ID on the Directory Categories when its listed in the dashboard
function my_tax_id($value, $name, $id)
{
	return 'tax_id' === $name ? $id : $value;
}

//custom filter for Technology form to check to see if the person inputing info is using a district email and then stopping and referring them to the Helpdesk instead. https://provo.edu/technology-home-support-form/
add_filter('wpcf7_validate_email*', 'custom_email_confirmation_validation_filter', 20, 2);

function custom_email_confirmation_validation_filter($result, $tag)
{
	if (isset($_POST['_wpcf7']) && $_POST['_wpcf7'] == 51410) {
		if ('your-email' == $tag->name) {
			$your_email = isset($_POST['your-email']) ? trim($_POST['your-email']) : '';
			//$your_email_confirm = isset( $_POST['your-email-confirm'] ) ? trim( $_POST['your-email-confirm'] ) : '';

			if (strpos($your_email, '@provo.edu')) {
				$result->invalidate($tag, "This form is for Student and Parents only. Please refer to Technology Support to submit a work order");
			}
		}
	}

	return $result;
}

/*
=============================================================================================
define allowed block types
=============================================================================================
*/
add_filter('allowed_block_types', 'pcsd_allowed_block_types');

function pcsd_allowed_block_types($allowed_blocks)
{
	return array(
		'core/paragraph',
		'core/image',
		'core/heading',
		'core/gallery',
		'core/list',
		'core/audio',
		'core/video',
		'core/table',
		'core/text-columns', // — Columns
		'core/buttons',
		//'core/quote', - need styling
		//'core/cover', //(previously core/cover-image)
		//'core/file', - we want to take a closer look at this one later
		//'core/verse', - revisit
		//'core/code', - needs styling
		//'core/freeform', // — Classic
		//'core/html', // — Custom HTML
		//'core/preformatted',
		//'core/pullquote', - revisit
		//(Deprecated) 'core/subhead', — Subheading
		//'core/media-text', // — Media and Text Revisit this one later
		//'core/more',
		//'core/nextpage', //— Page break
		//'core/separator',
		//'core/spacer',
		//'core/shortcode',
		//'core/archives',
		'core/categories',
		//'core/latest-comments',
		//'core/latest-posts',
		//'core/calendar',
		//'core/rss',
		//'core/search',
		//'core/tag-cloud',
		//'core/embed',
		//'core-embed/twitter',
		//'core-embed/youtube',
		//'core-embed/facebook',
		//'core-embed/instagram',
		//'core-embed/wordpress',
		//'core-embed/soundcloud',
		//'core-embed/spotify',
		//'core-embed/flickr',
		//'core-embed/vimeo',
		//'core-embed/animoto',
		//'core-embed/cloudup',
		//'core-embed/collegehumor',
		//'core-embed/dailymotion',
		//'core-embed/funnyordie',
		//'core-embed/hulu',
		//'core-embed/imgur',
		//'core-embed/issuu',
		//'core-embed/kickstarter',
		//'core-embed/meetup-com',
		//'core-embed/mixcloud',
		//'core-embed/photobucket',
		//'core-embed/polldaddy',
		//'core-embed/reddit',
		//'core-embed/reverbnation',
		//'core-embed/screencast',
		//'core-embed/scribd',
		//'core-embed/slideshare',
		//'core-embed/smugmug',
		//'core-embed/speaker',
		//'core-embed/ted',
		//'core-embed/tumblr',
		//'core-embed/videopress',
		//'core-embed/wordpress-tv'
	);
}
/*
=============================================================================================
register or unregister block patterns
=============================================================================================
*/
function my_plugin_unregister_my_patterns()
{
	remove_theme_support('core-block-patterns');
	unregister_block_pattern_category('columns');
	unregister_block_pattern_category('gallery');
	unregister_block_pattern_category('text');
}
add_action('init', 'my_plugin_unregister_my_patterns');

/*======================================================================================================================================================================================
Custom Post Types
======================================================================================================================================================================================*/

//Custom Post Type Variables
$pcsd_custom_post_type_icon = "https://globalassets.provo.edu/image/icons/pcsd-icon-16x16.png";

/*===========================================================================================
Post Type: Schools.
This is where the School Demographics page is managed
https://provo.edu/school-demographics/
===========================================================================================*/
$schools_labels = [
	"name" => __("Schools", "custom-post-type-ui"),
	"singular_name" => __("School", "custom-post-type-ui"),
	"featured_image" => __("School Photo", "custom-post-type-ui"),
	"set_featured_image" => __("Remove School Photo", "custom-post-type-ui"),
	"remove_featured_image" => __("Use School Photo", "custom-post-type-ui"),
];

$schools_args = [
	"label" => __("Schools", "custom-post-type-ui"),
	"labels" => $schools_labels,
	"description" => "",
	"public" => true,
	"publicly_queryable" => false,
	"show_ui" => true,
	"show_in_rest" => true,
	"rest_base" => "",
	"rest_controller_class" => "WP_REST_Posts_Controller",
	"has_archive" => false,
	"show_in_menu" => true,
	"show_in_nav_menus" => true,
	"delete_with_user" => false,
	"exclude_from_search" => false,
	"capability_type" => "post",
	"map_meta_cap" => true,
	"hierarchical" => true,
	"rewrite" => ["slug" => "schools", "with_front" => true],
	"query_var" => true,
	"menu_icon" => $pcsd_custom_post_type_icon,
	"supports" => ["title", "thumbnail"],
	"taxonomies" => ["school_fees_categories"],
];

register_post_type("schools", $schools_args);


/*======================================================================================================================================================================================
Custom Post Type Taxonomies
======================================================================================================================================================================================*/
function cptui_register_my_taxes()
{
	/*===========================================================================================
Taxonomy: Schools Demographics Listing Categories.
===========================================================================================*/

	$schools_demo_labels = [
		"name" => __("Schools Categories", "custom-post-type-ui"),
		"singular_name" => __("School Category", "custom-post-type-ui"),
	];

	$schools_demo_args = [
		"label" => __("Schools Categories", "custom-post-type-ui"),
		"labels" => $schools_demo_labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => ['slug' => 'school', 'with_front' => true,],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "school",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
	];
	register_taxonomy("school", ["schools"], $schools_demo_args);

	/*===========================================================================================
Taxonomy: Directory Categories.
===========================================================================================*/

	$directory_categories_labels = [
		"name" => __("Directory Categories", "custom-post-type-ui"),
		"singular_name" => __("Directory Category", "custom-post-type-ui"),
	];

	$directory_categories_args = [
		"label" => __("Directory Categories", "custom-post-type-ui"),
		"labels" => $directory_categories_labels,
		"public" => true,
		"publicly_queryable" => false,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => ['slug' => 'directory_category', 'with_front' => true,],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "directory_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
	];
	register_taxonomy("directory_category", ["directory"], $directory_categories_args);


	/*===========================================================================================
Taxonomy: Internship Location Categories
===========================================================================================*/

	$internship_locations_labels = [
		"name" => __("Internship Location Categories", "custom-post-type-ui"),
		"singular_name" => __("Internship Location Category", "custom-post-type-ui"),
	];

	$internship_locations_args = [
		"label" => __("Internship Location Categories", "custom-post-type-ui"),
		"labels" => $internship_locations_labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => ['slug' => 'internship_location_category', 'with_front' => true,],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "internship_location_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
	];
	register_taxonomy("internship_location_category", ["internship_locations"], $internship_locations_args);
}
add_action('init', 'cptui_register_my_taxes');

// adds class .active to top menu item if the current active page is the page in the menu 
// so that we can style that differently.
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item)
{
	if (in_array('current-menu-item', $classes)) {
		$classes[] = 'active ';
	}
	return $classes;
}
