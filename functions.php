<?php
add_action('after_setup_theme', 'boiler_setup');
function boiler_setup(){
load_theme_textdomain('boiler', get_template_directory() . '/languages');
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;

//Register Navigation Menus
register_nav_menus(
array( 
	'main-menu' => __( 'Main Menu', 'boiler' ),
	'footer-menu' => __( 'Footer Menu', 'boiler' ),
	)
);
}

add_filter('widget_text','do_shortcode');
add_action('comment_form_before', 'boiler_enqueue_comment_reply_script');
function boiler_enqueue_comment_reply_script()
{
if(get_option('thread_comments')) { wp_enqueue_script('comment-reply'); }
}

add_filter('the_title', 'boiler_title');
function boiler_title($title) {
if ($title == '') {
return 'Untitled';
} else {
return $title;
}
}

add_filter('wp_title', 'boiler_filter_wp_title');
function boiler_filter_wp_title($title)
{
return $title . esc_attr(get_bloginfo('name'));
}

add_filter('comment_form_defaults', 'boiler_comment_form_defaults');
function boiler_comment_form_defaults( $args )
{
$req = get_option( 'require_name_email' );
$required_text = sprintf( ' ' . __('Required fields are marked %s', 'boiler'), '<span class="required">*</span>' );
$args['comment_notes_before'] = '<p class="comment-notes">' . __('Your email is kept private.', 'boiler') . ( $req ? $required_text : '' ) . '</p>';
$args['title_reply'] = __('Post a Comment', 'boiler');
$args['title_reply_to'] = __('Post a Reply to %s', 'boiler');
return $args;
}
add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

// Register Widgets
add_action( 'widgets_init', 'boiler_widgets_init' );
function boiler_widgets_init() {
register_sidebar( array (
'name' => __('Copyright', 'boiler'),
'id' => 'copyright',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
) );
}

function boiler_get_page_number() {
if (get_query_var('paged')) {
print ' | ' . __( 'Page ' , 'boiler') . get_query_var('paged');
}
}

function boiler_catz($glue) {
$current_cat = single_cat_title( '', false );
$separator = "\n";
$cats = explode( $separator, get_the_category_list($separator) );
foreach ( $cats as $i => $str ) {
if ( strstr( $str, ">$current_cat<" ) ) {
unset($cats[$i]);
break;
}
}
if ( empty($cats) )
return false;
return trim(join( $glue, $cats ));
}

function boiler_tag_it($glue) {
$current_tag = single_tag_title( '', '',  false );
$separator = "\n";
$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
foreach ( $tags as $i => $str ) {
if ( strstr( $str, ">$current_tag<" ) ) {
unset($tags[$i]);
break;
}
}
if ( empty($tags) )
return false;
return trim(join( $glue, $tags ));
}

function boiler_commenter_link() {
$commenter = get_comment_author_link();
if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
} else {
$commenter = preg_replace( '/(<a )/', '\\1class="url "' , $commenter );
}
$avatar_email = get_comment_author_email();
$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}
function boiler_custom_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
$GLOBALS['comment_depth'] = $depth;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author vcard"><?php boiler_commenter_link() ?></div>
<div class="comment-meta"><?php printf(__('Posted %1$s at %2$s', 'boiler' ), get_comment_date(), get_comment_time() ); ?><span class="meta-sep"> | </span> <a href="#comment-<?php echo get_comment_ID(); ?>" title="<?php _e('Permalink to this comment', 'boiler' ); ?>"><?php _e('Permalink', 'boiler' ); ?></a>
<?php edit_comment_link(__('Edit', 'boiler'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') { echo '\t\t\t\t\t<span class="unapproved">'; _e('Your comment is awaiting moderation.', 'boiler'); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php
if($args['type'] == 'all' || get_comment_type() == 'comment') :
comment_reply_link(array_merge($args, array(
'reply_text' => __('Reply','boiler'),
'login_text' => __('Login to reply.', 'boiler'),
'depth' => $depth,
'before' => '<div class="comment-reply-link">',
'after' => '</div>'
)));
endif;
?>
<?php }
function boiler_custom_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'boiler'),
get_comment_author_link(),
get_comment_date(),
get_comment_time() );
edit_comment_link(__('Edit', 'boiler'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') { echo '\t\t\t\t\t<span class="unapproved">'; _e('Your trackback is awaiting moderation.', 'boiler'); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>

<?php }

add_filter('widget_tag_cloud_args','set_number_tags');
function set_number_tags($args) {
$args = array(
'format'  => 'list'
);
return $args;
}

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
	return '... &nbsp;<br /><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More ></a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
//Disable wp-emojis

function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

/**
 * Disable responsive image support (test!)
 */

// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );

//Slider Custom Post Type

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Sliders', 'Post Type General Name', 'boiler' ),
		'singular_name'       => _x( 'Slider', 'Post Type Singular Name', 'boiler' ),
		'menu_name'           => __( 'Sliders', 'boiler' ),
		'all_items'           => __( 'All Sliders', 'boiler' ),
		'view_item'           => __( 'View Slider', 'boiler' ),
		'add_new_item'        => __( 'Add New Slider', 'boiler' ),
		'add_new'             => __( 'Add New', 'boiler' ),
		'edit_item'           => __( 'Edit Slider', 'boiler' ),
		'update_item'         => __( 'Update Slider', 'boiler' ),
		'search_items'        => __( 'Search Slider', 'boiler' ),
		'not_found'           => __( 'Not Found', 'boiler' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'boiler' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'Sliders', 'boiler' ),
		'description'         => __( 'Create Sliders to use throughout your website.', 'boiler' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'genres' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-gallery',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'sliders', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type', 0 );


function load_my_scripts() {

    
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', '', '2.2.4', true);
        wp_enqueue_script('jquery');
        
        wp_deregister_script('jquery-migrate');
        wp_register_script('jquery-migrate', 'https://cdn.jsdelivr.net/jquery.migrate/1.2.1/jquery-migrate.min.js', '', '1.2.1', true);
        wp_enqueue_script('jquery-migrate');

        wp_deregister_script('jquery-ui');
        wp_register_script('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', '', '1.11.4', true);
        wp_enqueue_script('jquery-ui');
   
		wp_register_script('my-js', get_template_directory_uri() . '/js/scripts.js', '', '1.0', true);
		wp_enqueue_script('my-js');

		wp_register_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', '', '3.0', true);
		wp_enqueue_script('bootstrap-js');

		wp_register_script('cycle2', get_template_directory_uri() . '/js/jquery.cycle2.min.js', '', '2.0', true);
		wp_enqueue_script('cycle2');

		wp_register_script('carousel', get_template_directory_uri() . '/js/jquery.cycle2.carousel.js', '', '2.0', true);
		wp_enqueue_script('carousel');
		
	
}

add_action( 'wp_enqueue_scripts', 'load_my_scripts' );

function load_my_styles() {
	if (!is_admin()) {
		wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', '', '3.0','all');
		wp_enqueue_style('bootstrap');
		wp_register_style('main-css', get_template_directory_uri() . '/css/main.css', '', '1.0','all');
		wp_enqueue_style('main-css');
	}
}
add_action( 'wp_enqueue_scripts', 'load_my_styles' );  

/* TGM Plugin activation */
require_once get_stylesheet_directory() . '/inc/tgm_pa.php';
