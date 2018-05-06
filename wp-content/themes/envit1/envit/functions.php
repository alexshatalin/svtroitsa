<?php
$envit_theme = wp_get_theme();
define( 'ENVIT_THEME_VERSION', ( WP_DEBUG ) ? time() : $envit_theme->get( 'Version' ) );

if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

add_action( 'after_setup_theme', 'envit_theme_setup' );

if ( ! function_exists( 'envit_theme_setup' ) ) {

	function envit_theme_setup() {

		if ( ! get_post_meta( get_the_ID(), 'disable_tags', true ) ) {
		the_tags( '<div class="tags media-body">', ' ', '</div>' );
		}
		 
		//Image Croped for Latest News
		add_image_size( 'envit-image-370x202-croped', 370, 202, true );
		add_image_size( 'envit-image-570x240-croped', 570, 240, true );

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'envit' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );
		
		/*
    	 * Make theme available for translation.
    	 * Translations can be filed in the /languages/ directory.
    	 * If you're building a theme based on envit, use a find and replace
    	 * to change 'envit' to the name of your theme in all the template files.
    	 */
    	load_theme_textdomain( 'envit', get_template_directory() . '/languages' );
				
		/*
		  * Enable support for custome header and background for the images.
		  */
		 add_theme_support( 'custom-header' );
		 add_theme_support( 'custom-background' ) ;
		 // This theme styles the visual editor to resemble the theme style.
		 
		 add_editor_style( 'assets/css/editor-style.css' );
 
		register_nav_menus(
			array(
				'envit-primary_menu'   => esc_html__( 'Primary', 'envit' ),
				'envit-footer' => esc_html__( 'Footer', 'envit' ),
			)
		);

	}
}

function envit_read_more_link() {
    return '<a class="c-btn event_btn" href="' . get_permalink() . '">'.esc_html__('Read more','envit').'</a>';
}
add_filter( 'the_content_more_link', 'envit_read_more_link' );

//Default Home on breadcumb 
add_filter('bcn_breadcrumb_title', function($title, $type, $id) {
 if ($type[0] === 'home') {
  $title = get_the_title(get_option('page_on_front'));
 }
 return $title;
}, 42, 3);
	
/**
 * Load custom theme Footer Get In Touch widget.
**/
require get_template_directory() .'/inc/widgets/envit_get_in_touch.php';

/**
 * Load custom theme Services sidebar widget.
 */
require get_template_directory() . '/inc/widgets/envit_services.php';

/**
 * Load custom theme Logo text widget.
 */
require get_template_directory() . '/inc/widgets/envit_logo_text.php';

/**
 * Load custom theme Logo text widget.
 */
require get_template_directory() . '/inc/widgets/envit_socials.php';

/**
 * Load custom theme Posts Listing widget.
 */
require get_template_directory() . '/inc/widgets/envit_posts.php';
/**
 * Load custom theme Donate Now sidebar widget.
 */
require get_template_directory() . '/inc/widgets/envit_donate_now.php';

if ( ! function_exists( 'envit_register_default_sidebars' ) ) {
	function envit_register_default_sidebars() {
		
		//Right Sidebar
		register_sidebar( array(
			'id'            => 'envit-right-sidebar',
			'name'          => esc_html__( 'Right Sidebar', 'envit' ),
			'description'   => esc_html__( 'Add widgets here to appear in Right Sidebar', 'envit'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="recentTitle"><h5 class="h5 as">',
			'after_title'   => '</h5></div>',
		) );
		
		//Left Sidebar
		register_sidebar( array(
			'id'            => 'envit-left-sidebar',
			'name'          => esc_html__( 'Left Sidebar', 'envit' ),
			'description'   => esc_html__( 'Add widgets here to appear in Left Sidebar', 'envit'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="recentTitle"><h5 class="h5 as">',
			'after_title'   => '</h5></div>',
		) );
		
		//Services Sidebar
		register_sidebar( array(
			'id'            => 'envit-services-sidebar',
			'name'          => esc_html__( 'Services Sidebar', 'envit' ),
			'description'   => esc_html__( 'Add widgets here to appear in Services Sidebar', 'envit'),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<div class="recentTitle"><h5 class="h5 as">',
			'after_title'   => '</h5></div>',
		) );
						
		// Register Footer Sidebars
		for ( $footer = 1; $footer < 5; $footer ++ ) {
 
			register_sidebar( array(
				'id'            => 'envit-footer-' . $footer,
				'name'          => esc_html__( 'Footer ', 'envit' ) . $footer,
				'description'   => esc_html__( 'Add widgets here to appear in Footer Widget Area', 'envit'),
				'before_widget' => '<div id="%1$s" class="widget %2$s footerBlock normall">',
				'after_widget'  => '<div class="empty-space-sm-30"></div></div>',
				'before_title'  => '<div class="footerTitle"><p class="widget_title">',
				'after_title'   => '</p></div>',
			) );
		}
	}
}

add_action( 'widgets_init', 'envit_register_default_sidebars', 50 );
add_action( 'wp_enqueue_scripts', 'envit_load_theme_scripts_and_styles' );

if( ! function_exists( 'envit_load_theme_scripts_and_styles' ) ){
	function envit_load_theme_scripts_and_styles() {
		global $envit_option;
		if ( ! is_admin() ) {

			/* Register Styles */
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, ENVIT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'envit-style', get_stylesheet_uri(), null, ENVIT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'strock-icon', get_template_directory_uri() . '/assets/css/strock-icon.css', null, ENVIT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'envit-responsive', get_template_directory_uri() . '/assets/css/responsive.css', null, ENVIT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', null, ENVIT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', null, ENVIT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', null, ENVIT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'light-box', get_template_directory_uri() . '/assets/css/light_box.css', null, ENVIT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.css', null, ENVIT_THEME_VERSION, 'all' );
			wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/fonts/flaticon.css', null, ENVIT_THEME_VERSION, 'all' );
			
			/* Register Scripts */
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), ENVIT_THEME_VERSION, true );
			wp_enqueue_script( 'imagelightbox', get_template_directory_uri() . '/assets/js/imagelightbox.min.js', array( 'jquery' ), ENVIT_THEME_VERSION, true );
			wp_enqueue_script( 'barfiller', get_template_directory_uri() . '/assets/js/jquery.barfiller.js', array( 'jquery' ), ENVIT_THEME_VERSION, true );
			wp_enqueue_script( 'shuffle', get_template_directory_uri() . '/assets/js/jquery.shuffle.min.js', array( 'jquery' ), ENVIT_THEME_VERSION, true );
			wp_enqueue_script( 'carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), ENVIT_THEME_VERSION, true );
			wp_enqueue_script( 'suffle', get_template_directory_uri() . '/assets/js/suffle.js', array( 'jquery' ), ENVIT_THEME_VERSION, true );
			wp_enqueue_script( 'swiper-jquery', get_template_directory_uri() . '/assets/js/swiper.jquery.min.js', array( 'jquery' ), ENVIT_THEME_VERSION, true );
			wp_enqueue_script( 'envit-custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), ENVIT_THEME_VERSION, true );

			/* Enqueue Scripts */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}					
		}
	}
}


// Google fonts
function envit_fonts_url() {
$fonts_url = '';

/* Translators: If there are characters in your language that are not
* supported by Montserrat, translate this to 'off'. Do not translate
* into your own language.
*/
$Montserrat = _x( 'on', 'Montserrat font: on or off', 'envit' );

/* Translators: If there are characters in your language that are not
* supported by Open Sans, translate this to 'off'. Do not translate
* into your own language.
*/
$open_sans = _x( 'on', 'Open Sans font: on or off', 'envit' );
 
 /* Translators: If there are characters in your language that are not
* supported by Poppins, translate this to 'off'. Do not translate
* into your own language.
*/
$poppins = _x( 'on', 'Poppins Serif font: on or off', 'envit' ); 

/* Translators: If there are characters in your language that are not
* supported by Lato, translate this to 'off'. Do not translate
* into your own language.
*/
$Lato = _x( 'on', 'Lato Serif font: on or off', 'envit' ); 
  
	if ( 'off' !== $Montserrat || 'off' !== $open_sans ||  'off' !== $poppins  ||  'off' !== $Lato)
	{					
		$font_families = array();
		
			if ( 'off' !== $Montserrat ) 
			{
				$font_families[] = 'Montserrat:100,200,300,400,500,600,700,800,900';
			}
			if ( 'off' !== $open_sans ) 
			{
				$font_families[] = 'Open Sans:100,200,300,400,500,600,700,800,900';
			}
			if ( 'off' !== $poppins ) 
			{
				$font_families[] = 'Poppins:300,400,500,600,700';
			}
			if ( 'off' !== $Lato ) 
			{
				$font_families[] = 'Lato:300,400,500,600,700';
			}
			
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' )
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}
function envit_scripts_styles() 
{
	wp_enqueue_style( 'fonts', envit_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'envit_scripts_styles' );

if( ! function_exists( 'envit_body_class' ) ) {
	function envit_body_class( $classes ) {
		
		global $envit_option;
		$classes[] = envit_get_header_style();

		return $classes;
	}
}

add_filter( 'body_class', 'envit_body_class' );

define( 'ENVIT_INC_PATH', get_template_directory() . '/inc' );
require_once( ENVIT_INC_PATH . '/tgm/tgm-plugin-registration.php' );
require_once( ENVIT_INC_PATH . '/theme-essential.php' );
require_once( ENVIT_INC_PATH . '/visual-composer.php' );

/************************************************************************
* Customize Button of Comment Form
*************************************************************************/
  
function envit_form_submit_button($button) {
$button =
'<input type="submit" value="Submit now" class="c-btn button">'; //. //Add your html codes here
//get_comment_id_fields();
return $button;
}
add_filter('comment_form_submit_button', 'envit_form_submit_button');

if ( !function_exists( 'envit_extended_import' ) ) {
 function envit_extended_import( $demo_active_import , $demo_directory_path ) {

  reset( $demo_active_import );
  $current_key = key( $demo_active_import );

 //Import Sliders
if ( class_exists( 'RevSlider' ) ) {
    $wbc_sliders_array = array(
        'demo1' => array('home1.zip','home2.zip','home3.zip','home4.zip')
    );
    if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
        $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

        if( is_array( $wbc_slider_import ) ){
            foreach ($wbc_slider_import as $slider_zip) {
                if ( !empty($slider_zip) && file_exists( $demo_directory_path.$slider_zip ) ) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost( true, true, $demo_directory_path.$slider_zip );
                }
            }
        }else{
            if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
            }
        }
    }
}
  
  /************************************************************************
  * Setting Menus
  *************************************************************************/

  $wbc_menu_array = array( 'demo1');
			
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$top_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
		  
			if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'envit-primary_menu' => $top_menu->term_id					   
					)
				);
			}
		}
		

		
  /************************************************************************
  * Set HomePage
  *************************************************************************/

  // array of demos/homepages to check/select from
  $wbc_home_pages = array(
		'demo1' => 'Home',
  );

  if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) 
  {
	   $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
		   if ( isset( $page->ID ) ) 
		   {
			update_option( 'page_on_front', $page->ID );
			update_option( 'show_on_front', 'page' );
		   }
  }
  
 }
  add_action( 'wbc_importer_after_content_import', 'envit_extended_import', 10, 2 );
}


/************************************************************************
* Set Inner header and footer background image/color.
*************************************************************************/

function backgroundStyle( $key ){
 global $envit_option;
 $inner_header_style = array();
 if ( isset($envit_option[''.esc_attr($key).'']) && $envit_option[''.esc_attr($key).'']['background-image'] != '' )
 {
  $inner_header_style[] = 'background-image: url('.$envit_option[''.esc_attr($key).'']['background-image'].');';
 }
 if ( isset($envit_option[''.esc_attr($key).'']) && $envit_option[''.esc_attr($key).'']['background-color'] != '' )
 {
  $inner_header_style[] = 'background-color: '.$envit_option[''.esc_attr($key).'']['background-color'].';';
 }
 if ( isset($envit_option[''.esc_attr($key).'']) && $envit_option[''.esc_attr($key).'']['background-repeat'] != '' )
 {
  $inner_header_style[] = 'background-repeat: '.$envit_option[''.esc_attr($key).'']['background-repeat'].';';
 }
 if ( isset($envit_option[''.esc_attr($key).'']) && $envit_option[''.esc_attr($key).'']['background-size'] != '' )
 {
  $inner_header_style[] = 'background-size: '.$envit_option[''.esc_attr($key).'']['background-size'].';';
 }
 if ( isset($envit_option[''.esc_attr($key).'']) && $envit_option[''.esc_attr($key).'']['background-position'] != '' )
 {
  $inner_header_style[] = 'background-position: '.$envit_option[''.esc_attr($key).'']['background-position'].';';
 }
 if ( isset($envit_option[''.esc_attr($key).'']) && $envit_option[''.esc_attr($key).'']['background-attachment'] != '' )
 {
  $inner_header_style[] = 'background-attachment: '.$envit_option[''.esc_attr($key).'']['background-attachment'].';';
 }
 return $inner_header_style;
}