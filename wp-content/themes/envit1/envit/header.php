<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till 
 *
 * @package tmchampion
 */
global $envit_option;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
	if(isset($envit_option['layout_style']) && $envit_option['layout_style'] == 2)
	{ 
		$class_name = 'boxed-container';
	}
	else
	{ 
		$class_name = 'boxed-full';
	} 
	 ?>
<div id="content-wrapper" class="<?php echo esc_attr($class_name); ?>">
		<?php 
			if(!empty($envit_option['header_style']))
			{				
				$headear = $envit_option['header_style'];
			}
			else
			{				
				$headear ='envit_header_1';
			}

			// passing header value in header_layout function &call
			if (!is_404()) {
				envit_header_layout($headear);
			}
	
			if (! is_front_page() && ! is_404() && !is_page('home-two') && !is_page('home-three')&& !is_page('home-four'))
			{
				envit_header_page_title();
			}
			$classOne = '';
			if(! is_404())
			{
				$classOne = 'container mainPadding';
			} ?>
<div class="envit <?php echo esc_attr($classOne); ?>">