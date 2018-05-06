<?php
/*
Plugin Name: TMC Post Type
Plugin URI:
Description: TMC Post Type
Author: ThemeChampion
Author URI: http://www.themechampion.com
Text Domain: tmc_post_type
Version: 1.0
*/

define( 'TMC_POST_TYPE', 'tmc_post_type' );
function custom_post_type_init() {

$options_meta = get_option('tmc_post_types_options');
	$tmcPostTypesOptions = array(

	
		'team' => array(
			'title' => __( 'Team', TMC_POST_TYPE ),
			'rewrite' => 'team'
		),
		'clients' => array(
			'title' => __( 'Clients', TMC_POST_TYPE ),
			'rewrite' => 'clients'
		),
		'gallery' => array(
			'title' => __( 'Gallery', TMC_POST_TYPE ),
			'rewrite' => 'gallery'
		),
		'services' => array(
			'title' => __( 'Services', TMC_POST_TYPE ),
			'rewrite' => 'services'
		),
		'testimonials' => array(
			'title' => __( 'Testimonials', TMC_POST_TYPE ),
			'rewrite' => 'testimonials'
		),
		
		
		
				
	);
	$tmc_post_types_options = wp_parse_args( $options_meta, $tmcPostTypesOptions );


	 register_post_type(
    'sidebar', array(
      'labels' => array('name' => __( 'Sidebar' ),
	  'singular_name' => __( 'sidebar' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-schedule',
      'supports' => array( 'title', 'editor' ), 
	  'exclude_from_search' => true, 
	  'publicly_queryable' => false 
    )
  );
  
	
	

	/**
	 * Post Type: Team.
	 */

	$labels = array(
		"name" => $tmc_post_types_options['team']['title'],
		"singular_name" => __( 'Team', 'envit' ),
	);

	$args = array(
		"label" => __( 'Team', 'envit' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"menu_icon" => 'dashicons-groups',
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		'rewrite' => array( 'slug' => $tmc_post_types_options['team']['rewrite'] ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
	);

	register_post_type( "team", $args );

	/**
	 * Post Type: Clients.
	 */

	$labels = array(
		"name" => $tmc_post_types_options['clients']['title'],
		"singular_name" => __( 'Clients', 'envit' ),
	);

	$args = array(
		"label" => __( 'Clients', 'envit' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"menu_icon" => 'dashicons-phone',
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		'rewrite' => array( 'slug' => $tmc_post_types_options['clients']['rewrite'] ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
	);

	register_post_type( "clients", $args );


	/**
	 * Post Type: Gallery.
	 */

	$labels = array(
		"name" => $tmc_post_types_options['gallery']['title'],
		"singular_name" => __( 'Gallery', 'envit' ),
	);

	$args = array(
		"label" => __( 'Gallery', 'envit' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"menu_icon" => 'dashicons-format-gallery',
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		'rewrite' => array( 'slug' => $tmc_post_types_options['gallery']['rewrite'] ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
	);

	register_post_type( "gallery", $args );

	/**
	 * Post Type: Services.
	 */

	$labels = array(
		"name" => $tmc_post_types_options['services']['title'],
		"singular_name" => __( 'Services', 'envit' ),
	);

	$args = array(
		"label" => __( 'Services', 'envit' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"menu_icon" => 'dashicons-chart-line',
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		'rewrite' => array( 'slug' => $tmc_post_types_options['services']['rewrite'] ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
	);

	register_post_type( "services", $args );
	
	/**
	* Post Type: Testimonials.
	*/

	$labels = array(
		"name" => $tmc_post_types_options['testimonials']['title'],
		"singular_name" => __( 'Testimonials', 'envit' ),
	);

	$args = array(
		"label" => __( 'Testimonials', 'envit' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"menu_icon" => 'dashicons-testimonial',
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		'rewrite' => array( 'slug' => $tmc_post_types_options['testimonials']['rewrite'] ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
	);

	register_post_type( "testimonials", $args );

}

add_action( 'init', 'custom_post_type_init' );

function custom_post_type_tax_init() {
	
	register_taxonomy(
		'team_category',
		'team',
		array(
			'label' => __( 'Team categories' ),
			'rewrite' => array( 'slug' => 'team' ),
			'hierarchical' => true,
		)
	);
	
	register_taxonomy(
		'clients_category',
		'clients',
		array(
			'label' => __( 'Clients categories' ),
			'rewrite' => array( 'slug' => 'clients' ),
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'gallery_category',
		'gallery',
		array(
			'label' => __( 'Gallery categories' ),
			'rewrite' => array( 'slug' => 'gallery' ),
			'hierarchical' => true,
		)
	);
	
	register_taxonomy(
		'services_category',
		'services',
		array(
			'label' => __( 'Services categories' ),
			'rewrite' => array( 'slug' => 'services' ),
			'hierarchical' => true,
		)
	);
	
	register_taxonomy(
		'testimonials_category',
		'testimonials',
		array(
			'label' => __( 'Testimonials categories' ),
			'rewrite' => array( 'slug' => 'testimonials' ),
			'hierarchical' => true,
		)
	);
	
	
}
add_action( 'init', 'custom_post_type_tax_init' );

// TO add Meta boxes Units
function wdm_add_meta_box_unit() {
	add_meta_box('wdm_section_designation', 'Designation', 'wdm_meta_box_team_designation', 'team');
	add_meta_box('wdm_section_social', 'Socials Links', 'wdm_meta_box_social', 'team');
	add_meta_box('wdm_section_contact', 'Contact Number', 'wdm_meta_box_contact', 'team');
	add_meta_box('wdm_section_email', 'Email Address', 'wdm_meta_box_email', 'team');
	add_meta_box('wdm_section_unit', 'Services Icon', 'wdm_meta_box_services_icon', 'services');
	add_meta_box('wdm_section_masonry', 'Masonry Image', 'wdm_meta_box_masonry_gallery', 'gallery');
	add_meta_box('wdm_section_page', 'Page', 'wdm_meta_box_page', 'page');
	add_meta_box('wdm_section_service', 'Services', 'wdm_meta_box_service', 'services');
	add_meta_box('wdm_section_team', 'Team', 'wdm_meta_box_team', 'team');
	add_meta_box('wdm_section_post', 'Post', 'wdm_meta_box_post', 'post');
	add_meta_box('wdm_section_shop', 'Shop', 'wdm_meta_box_product', 'product');
	add_meta_box('wdm_section_testimonial', 'Testimonial', 'wdm_meta_testimonial', 'testimonials');
}
add_action( 'add_meta_boxes', 'wdm_add_meta_box_unit' );

function wdm_meta_box_page( $post ) {
	
        $value = get_post_meta( $post->ID, 'header-image', true );
		$value3 = get_post_meta( $post->ID, 'hide-page-title', true );
		$value4 = get_post_meta( $post->ID, 'hide-breadcrumb', true );
		$value5 = get_post_meta( $post->ID, 'page-header-title', true );
		$value6 = get_post_meta( $post->ID, 'title-alignment', true );
		$value7 = get_post_meta( $post->ID, 'title-padding-top', true );
		$value8 = get_post_meta( $post->ID, 'title-padding-bottom', true );
        ?>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide page title?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="hide-page-title" value="yes" <?php if($value3 == 'yes') echo 'checked'; else echo '';?> >
				<span class="meta-description">Check this box to hide page title.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide breadcrumb?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="hide-breadcrumb" value="yes" <?php if($value4 == 'yes') echo 'checked'; else echo '';?>>
				<span class="meta-description">Check this box to hide breadcrumb for this page.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Title</label>
			</div>
			<div class="meta-value metaPageValue metaInput">
				<input type="text" name="page-header-title" value="<?php if($value5) echo esc_attr($value5); else echo '';  ?>">
				<p class="meta-description title">Enter in the page header title here.</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Title Alignment</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="radio" name="title-alignment" value="left" <?php if($value6 == 'left') echo 'checked'; else echo '';?>><span class="alignmentTitle">Left</span> 
				<input type="radio" name="title-alignment" value="center" <?php if($value6 == 'center') echo 'checked'; else echo '';?>><span class="alignmentTitle">Center</span> 
				<input type="radio" name="title-alignment" value="right" <?php if($value6 == 'right') echo 'checked'; else echo '';?>><span class="alignmentTitle">Right</span>
				<p class="meta-description align">Choose how you would like your header text to be aligned</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Top</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="title-padding-top" value="<?php if($value7) echo esc_attr($value7); else echo '';  ?>">
				<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Bottom</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="title-padding-bottom" value="<?php if($value8) echo esc_attr($value8); else echo '';  ?>">
				<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
			</div>
		</div>
		
		<div class="row mainBody borderBottomNone">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Image</label>
			</div>
			<div class="meta-value metaPageValue"> 
			<?php 
					  
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					
					
					?>
						<div class="tmc_metabox_image_page">
							<input name="header-image" type="hidden" class="custom_upload_image" value="<?php echo $value ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>
					<p class="meta-description title">The image should be between 1500px - 2000px wide and have a minimum height of 328px for best results.</p>		
			</div>
		</div>
		
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
		</script>
	<?php 	
}

function wdm_meta_box_service( $post ) {
	
        $value = get_post_meta( $post->ID, 'service-header-image', true );
        $value3 = get_post_meta( $post->ID, 'service-hide-page-title', true );
		$value4 = get_post_meta( $post->ID, 'service-hide-breadcrumb', true );
		$value5 = get_post_meta( $post->ID, 'service-header-title', true );
		$value6 = get_post_meta( $post->ID, 'service-title-alignment', true );
		$value7 = get_post_meta( $post->ID, 'service-title-padding-top', true );
		$value8 = get_post_meta( $post->ID, 'service-title-padding-bottom', true );
        ?>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide page title?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="service-hide-page-title" value="yes" <?php if($value3 == 'yes') echo 'checked'; else echo '';?> >
				<span class="meta-description">Check this box to hide page title.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide breadcrumb?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="service-hide-breadcrumb" value="yes" <?php if($value4 == 'yes') echo 'checked'; else echo '';?>>
				<span class="meta-description">Check this box to hide breadcrumb for this page.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Title</label>
			</div>
			<div class="meta-value metaPageValue metaInput">
				<input type="text" name="service-header-title" value="<?php if($value5) echo esc_attr($value5); else echo '';  ?>">
				<p class="meta-description title">Enter in the page header title here.</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Title Alignment</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="radio" name="service-title-alignment" value="left" <?php if($value6 == 'left') echo 'checked'; else echo '';?>><span class="alignmentTitle">Left</span> 
				<input type="radio" name="service-title-alignment" value="center" <?php if($value6 == 'center') echo 'checked'; else echo '';?>><span class="alignmentTitle">Center</span> 
				<input type="radio" name="service-title-alignment" value="right" <?php if($value6 == 'right') echo 'checked'; else echo '';?>><span class="alignmentTitle">Right</span>
				<p class="meta-description align">Choose how you would like your header text to be aligned</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Top</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="service-title-padding-top" value="<?php if($value7) echo esc_attr($value7); else echo '';  ?>">
				<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Bottom</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="service-title-padding-bottom" value="<?php if($value8) echo esc_attr($value8); else echo '';  ?>">
				<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
			</div>
		</div>

		<div class="row">
			<div class="meta-lable metaPageLable">
				<label>Inner Header Image</label>
			</div>
			<div class="meta-value metaPageValue"> 
			<?php 
					  
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					
					
					?>
						<div class="tmc_metabox_image_page">
							<input name="service-header-image" type="hidden" class="custom_upload_image" value="<?php echo $value ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>			
			</div>
		</div>
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
		</script>
	<?php 	
}

function wdm_meta_box_team( $post ) {
	
        $value = get_post_meta( $post->ID, 'team-header-image', true );
        $value3 = get_post_meta( $post->ID, 'team-hide-page-title', true );
		$value4 = get_post_meta( $post->ID, 'team-hide-breadcrumb', true );
		$value5 = get_post_meta( $post->ID, 'team-header-title', true );
		$value6 = get_post_meta( $post->ID, 'team-title-alignment', true );
		$value7 = get_post_meta( $post->ID, 'team-title-padding-top', true );
		$value8 = get_post_meta( $post->ID, 'team-title-padding-bottom', true );
        ?>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide page title?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="team-hide-page-title" value="yes" <?php if($value3 == 'yes') echo 'checked'; else echo '';?> >
				<span class="meta-description">Check this box to hide page title.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide breadcrumb?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="team-hide-breadcrumb" value="yes" <?php if($value4 == 'yes') echo 'checked'; else echo '';?>>
				<span class="meta-description">Check this box to hide breadcrumb for this page.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Title</label>
			</div>
			<div class="meta-value metaPageValue metaInput">
				<input type="text" name="team-header-title" value="<?php if($value5) echo esc_attr($value5); else echo '';  ?>">
				<p class="meta-description title">Enter in the page header title here.</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Title Alignment</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="radio" name="team-title-alignment" value="left" <?php if($value6 == 'left') echo 'checked'; else echo '';?>><span class="alignmentTitle">Left</span> 
				<input type="radio" name="team-title-alignment" value="center" <?php if($value6 == 'center') echo 'checked'; else echo '';?>><span class="alignmentTitle">Center</span> 
				<input type="radio" name="team-title-alignment" value="right" <?php if($value6 == 'right') echo 'checked'; else echo '';?>><span class="alignmentTitle">Right</span>
				<p class="meta-description align">Choose how you would like your header text to be aligned</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Top</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="team-title-padding-top" value="<?php if($value7) echo esc_attr($value7); else echo '';  ?>">
				<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Bottom</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="team-title-padding-bottom" value="<?php if($value8) echo esc_attr($value8); else echo '';  ?>">
				<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
			</div>
		</div>

	
		<div class="row">
			<div class="meta-lable metaPageLable">
				<label> Inner Header Image</label>
			</div>
			<div class="meta-value metaPageValue"> 
			<?php 
					  
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					
					
					?>
						<div class="tmc_metabox_image_page">
							<input name="team-header-image" type="hidden" class="custom_upload_image" value="<?php echo $value ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>			
			</div>
		</div>
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
		</script>
	<?php 	
}

function wdm_meta_box_post( $post ) {
	
        $value = get_post_meta( $post->ID, 'post-header-image', true );
		$value3 = get_post_meta( $post->ID, 'post-hide-page-title', true );
		$value4 = get_post_meta( $post->ID, 'post-hide-breadcrumb', true );
		$value5 = get_post_meta( $post->ID, 'post-header-title', true );
		$value6 = get_post_meta( $post->ID, 'post-title-alignment', true );
		$value7 = get_post_meta( $post->ID, 'post-title-padding-top', true );
		$value8 = get_post_meta( $post->ID, 'post-title-padding-bottom', true );
        ?>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide page title?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="post-hide-page-title" value="yes" <?php if($value3 == 'yes') echo 'checked'; else echo '';?> >
				<span class="meta-description">Check this box to hide page title.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide breadcrumb?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="post-hide-breadcrumb" value="yes" <?php if($value4 == 'yes') echo 'checked'; else echo '';?>>
				<span class="meta-description">Check this box to hide breadcrumb for this page.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Title</label>
			</div>
			<div class="meta-value metaPageValue metaInput">
				<input type="text" name="post-header-title" value="<?php if($value5) echo esc_attr($value5); else echo '';  ?>">
				<p class="meta-description title">Enter in the page header title here.</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Title Alignment</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="radio" name="post-title-alignment" value="left" <?php if($value6 == 'left') echo 'checked'; else echo '';?>><span class="alignmentTitle">Left</span> 
				<input type="radio" name="post-title-alignment" value="center" <?php if($value6 == 'center') echo 'checked'; else echo '';?>><span class="alignmentTitle">Center</span> 
				<input type="radio" name="post-title-alignment" value="right" <?php if($value6 == 'right') echo 'checked'; else echo '';?>><span class="alignmentTitle">Right</span>
				<p class="meta-description align">Choose how you would like your header text to be aligned</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Top</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="post-title-padding-top" value="<?php if($value7) echo esc_attr($value7); else echo '';  ?>">
				<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Bottom</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="post-title-padding-bottom" value="<?php if($value8) echo esc_attr($value8); else echo '';  ?>">
				<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row">
			<div class="meta-lable metaPageLable">
				<label>Inner Header Image</label>
			</div>
			<div class="meta-value metaPageValue"> 
			<?php 
					  
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					
					
					?>
						<div class="tmc_metabox_image_page">
							<input name="post-header-image" type="hidden" class="custom_upload_image" value="<?php echo $value ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>		
			</div>
		</div>
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
		</script>
	<?php 	
}


function wdm_meta_box_product( $post ) {
	
        $value = get_post_meta( $post->ID, 'product-header-image', true );
		$value3 = get_post_meta( $post->ID, 'product-hide-page-title', true );
		$value4 = get_post_meta( $post->ID, 'product-hide-breadcrumb', true );
		$value5 = get_post_meta( $post->ID, 'product-header-title', true );
		$value6 = get_post_meta( $post->ID, 'product-title-alignment', true );
		$value7 = get_post_meta( $post->ID, 'product-title-padding-top', true );
		$value8 = get_post_meta( $post->ID, 'product-title-padding-bottom', true );
        ?>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide page title?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="product-hide-page-title" value="yes" <?php if($value3 == 'yes') echo 'checked'; else echo '';?> >
				<span class="meta-description">Check this box to hide page title.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide breadcrumb?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="product-hide-breadcrumb" value="yes" <?php if($value4 == 'yes') echo 'checked'; else echo '';?>>
				<span class="meta-description">Check this box to hide breadcrumb for this page.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Title</label>
			</div>
			<div class="meta-value metaPageValue metaInput">
				<input type="text" name="product-header-title" value="<?php if($value5) echo esc_attr($value5); else echo '';  ?>">
				<p class="meta-description title">Enter in the page header title here.</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Title Alignment</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="radio" name="product-title-alignment" value="left" <?php if($value6 == 'left') echo 'checked'; else echo '';?>><span class="alignmentTitle">Left</span> 
				<input type="radio" name="product-title-alignment" value="center" <?php if($value6 == 'center') echo 'checked'; else echo '';?>><span class="alignmentTitle">Center</span> 
				<input type="radio" name="product-title-alignment" value="right" <?php if($value6 == 'right') echo 'checked'; else echo '';?>><span class="alignmentTitle">Right</span>
				<p class="meta-description align">Choose how you would like your header text to be aligned</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Top</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="product-title-padding-top" value="<?php if($value7) echo esc_attr($value7); else echo '';  ?>">
				<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Bottom</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="product-title-padding-bottom" value="<?php if($value8) echo esc_attr($value8); else echo '';  ?>">
				<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
			</div>
		</div>

		<div class="row mainBody borderBottomNone">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Image</label>
			</div>
			<div class="meta-value metaPageValue"> 
			<?php 
					  
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					
					
					?>
						<div class="tmc_metabox_image_page">
							<input name="product-header-image" type="hidden" class="custom_upload_image" value="<?php echo $value ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>
					<p class="meta-description title">The image should be between 1500px - 2000px wide and have a minimum height of 328px for best results.</p>		
			</div>
		</div>
		
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
		</script>
	<?php 	
}

function wdm_meta_testimonial( $post ) {
       $testimonialDes = get_post_meta( $post->ID, 'envit_testimonial_designation', true );
        ?>
		<div class="meta-lable metaPageLable">
			<label class="meta-section-title">Designation:</label>
		</div>
        <div class="row">
			<div class="meta-value">
				<input type="text" name="envit_testimonial_designation" value="<?php if($testimonialDes) echo esc_attr($testimonialDes); else echo 'Volunteer';  ?>">
			</div>
		</div>		
        <?php
}

function wdm_meta_box_team_designation( $post ) {
       $teamdesignation = get_post_meta( $post->ID, '_envit_member_designation', true );
        ?>
        <div class="row">
			<div class="meta-value">
				<input type="text" name="_envit_member_designation" value="<?php if($teamdesignation) echo esc_attr($teamdesignation); else echo 'Designation';  ?>">
			</div>
		</div>		
        <?php
}
function wdm_meta_box_social( $post ) {
        $facebook = get_post_meta( $post->ID, '_envit_social_facebook', true ); 
		$twitter = get_post_meta( $post->ID, '_envit_social_twitter', true ); 
		$google_plus = get_post_meta( $post->ID, '_envit_social_google_plus', true ); 
		$linkedin = get_post_meta( $post->ID, '_envit_social_linkedin', true ); 
        ?>
        <div class="row d-inline">
			<div class="meta-lable">
				<label><?php echo esc_html__('Facebook', 'envit'); ?></label>
			</div>
			<div class="meta-value">
				<input type="text" name="_envit_social_facebook" value="<?php if($facebook) echo esc_attr($facebook); else echo '#';  ?>">
			</div>
		</div>
		<div class="row d-inline">
			<div class="meta-lable">
				<label><?php echo esc_html__('Twitter', 'envit'); ?></label>
			</div>
			<div class="meta-value">
				<input type="text" name="_envit_social_twitter" value="<?php if($twitter) echo esc_attr($twitter); else echo '#';  ?>">
			</div>
		</div>
		<div class="row d-inline">
			<div class="meta-lable">
				<label><?php echo esc_html__('Google-Plus', 'envit'); ?></label>
			</div>
			<div class="meta-value">
				<input type="text" name="_envit_social_google_plus" value="<?php if($google_plus) echo esc_attr($google_plus); else echo '#';  ?>">
			</div>
		</div>
		<div class="row d-inline">
			<div class="meta-lable">
				<label><?php echo esc_html__('Linkedin', 'envit'); ?></label>
			</div>
			<div class="meta-value">
				<input type="text" name="_envit_social_linkedin" value="<?php if($linkedin) echo esc_attr($linkedin); else echo '#';  ?>">
			</div>
		</div>
        <?php
}
function wdm_meta_box_contact( $post ) {
        $contact_number = get_post_meta( $post->ID, '_envit_contact_number', true );
        ?>
        <div class="row">
			<div class="meta-value">
			<input type="tel" name="_envit_contact_number" value="<?php if($contact_number) echo esc_attr($contact_number); else echo ' 1800 (123) 4567';  ?>">
			</div>
		</div>		
        <?php
}
function wdm_meta_box_email( $post ) {
	
        $email_address = get_post_meta( $post->ID, '_envit_email_address', true );
        ?>
        <div class="row">
			<div class="meta-value">
				<input type="text" name="_envit_email_address" value="<?php if($email_address) echo esc_attr($email_address); else echo 'michalejohn@envit.com';  ?>">
			</div>
		</div>		
        <?php
}

function wdm_meta_box_services_icon( $post ) {
	
        $value = get_post_meta( $post->ID, '_envit_services_icon', true );
        ?>
        <div class="row">
			<div class="meta-value">
				<input type="text" name="_envit_services_icon" value="<?php if($value) echo esc_attr($value); else echo 'flaticon-arrows';  ?>">
			</div>
		</div>
		<span class="meta-description">Select icon name form <a href="https://www.flaticon.com">flaticon</a> and write in the box.</span>
	<?php 	
}


function wdm_meta_box_masonry_gallery( $post ) {
	
        $value = get_post_meta( $post->ID, '_envit_masonry_gallery', true );
        ?>
		
		<div class="row">
			<div class="meta-lable">
				<label><?php echo esc_html__('Masonry Image', 'envit'); ?></label>
			</div>
			<div class="meta-value"> 
			<?php 
					  $default_image = plugin_dir_url( __FILE__ ) . 'images/img-icon.png';
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					if( empty($image) ){
						$image = $default_image;
					}
					?>
						<div class="envit_metabox_image">
							<input name="_envit_masonry_gallery" type="hidden" class="custom_upload_image" value="<?php  echo esc_attr($value) ; ?>" />
							<img src="<?php  echo esc_attr($image); ?>" class="custom_preview_image" alt="" />
							<input class="envit_upload_image upload_button_envit_masonry_gallery button-primary" type="button" value="<?php echo  esc_html__( 'Choose Image', 'envit' ) ; ?>" />
							<a href="#" class="envit_remove_image button"><?php echo esc_html__( 'Remove Image', 'envit' ); ?></a>
						</div>			
			</div>
		</div>
		
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_envit_masonry_gallery").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php  echo esc_html__( 'Select image', 'envit'); ?>",
						button  : {
							text: "<?php  echo esc_html__( 'Attach', 'envit' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".envit_metabox_image").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".envit_metabox_image").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".envit_remove_image").click(function(){
					$(this).closest(".envit_metabox_image").find(".custom_upload_image").val("");
					$(this).closest(".envit_metabox_image").find(".custom_preview_image").attr("src", "<?php echo esc_url($default_image); ?>");
					return false;
				});
			});
		</script>
	<?php 	
}

function wdm_save_meta_box_data_unit( $post_id ) {
				
	// envit Member Designation
	$teamdesignation = ( isset( $_POST['_envit_member_designation'] ) ?  $_POST['_envit_member_designation'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_envit_member_designation', $teamdesignation );
	
	// envit Member Designation
	$testimonialDes = ( isset( $_POST['envit_testimonial_designation'] ) ?  $_POST['envit_testimonial_designation'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'envit_testimonial_designation', $testimonialDes );	
	
	// Social Facebook
	$facebook = ( isset( $_POST['_envit_social_facebook'] ) ?  $_POST['_envit_social_facebook'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_envit_social_facebook', $facebook );
	
	// Social Twitter
	$twitter = ( isset( $_POST['_envit_social_twitter'] ) ? $_POST['_envit_social_twitter'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_envit_social_twitter', $twitter );
	
	// Social Skype
	$google_plus = ( isset( $_POST['_envit_social_google_plus'] ) ?  $_POST['_envit_social_google_plus'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_envit_social_google_plus', $google_plus );
	
	// Social Linkedin
	$linkedin = ( isset( $_POST['_envit_social_linkedin'] ) ? $_POST['_envit_social_linkedin'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_envit_social_linkedin', $linkedin );
	
	// envit Contact Number
	$contact_number = ( isset( $_POST['_envit_contact_number'] ) ?  $_POST['_envit_contact_number']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_envit_contact_number', $contact_number );

	// envit Email Address
	$email_address = ( isset( $_POST['_envit_email_address'] ) ?  $_POST['_envit_email_address']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_envit_email_address', $email_address );
	
	// Services Icon
	$icon = ( isset( $_POST['_envit_services_icon'] ) ? sanitize_html_class( $_POST['_envit_services_icon'] ) : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_envit_services_icon', $icon );

	// Masonry Image
	$icon = ( isset( $_POST['_envit_masonry_gallery'] ) ?  $_POST['_envit_masonry_gallery'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_envit_masonry_gallery', $icon );
		
	// envit Meta Page Module

	// envit Page Image
    $pageInnerMain = ( isset( $_POST['header-image'] ) ?  $_POST['header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'header-image', $pageInnerMain );
	
	// envit Hide Page title
	$hidePageTitle = ( isset( $_POST['hide-page-title'] ) ?  $_POST['hide-page-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'hide-page-title', $hidePageTitle );
	
	// envit Hide Breadcrumb
	$hideBreadcrumb = ( isset( $_POST['hide-breadcrumb'] ) ?  $_POST['hide-breadcrumb']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'hide-breadcrumb', $hideBreadcrumb );
		
	// envit Page Header Title
    $pageHeaderTitle = ( isset( $_POST['page-header-title'] ) ?  $_POST['page-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-header-title', $pageHeaderTitle );

	// envit Title Alignment
       $titleAligment = ( isset( $_POST['title-alignment'] ) ?  $_POST['title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'title-alignment', $titleAligment );
	
	// envit Title Padding Top
       $titlePaddingTop = ( isset( $_POST['title-padding-top'] ) ?  $_POST['title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'title-padding-top', $titlePaddingTop );
	
	// envit Title Padding Bottom
       $titlePaddingBottom = ( isset( $_POST['title-padding-bottom'] ) ?  $_POST['title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'title-padding-bottom', $titlePaddingBottom );

	// envit Meta Service Module
	
	// envit Service Image
	$serviceInnerMain = ( isset( $_POST['service-header-image'] ) ?  $_POST['service-header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-header-image', $serviceInnerMain );
	
	// envit Hide Page title
	$serviceHidePageTitle = ( isset( $_POST['service-hide-page-title'] ) ?  $_POST['service-hide-page-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-hide-page-title', $serviceHidePageTitle );
	
	// envit Hide Breadcrumb
	$serviceHideBreadcrumb = ( isset( $_POST['service-hide-breadcrumb'] ) ?  $_POST['service-hide-breadcrumb']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-hide-breadcrumb', $serviceHideBreadcrumb );
		
	// envit Page Header Title
    $servicePageHeaderTitle = ( isset( $_POST['service-header-title'] ) ?  $_POST['service-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-header-title', $servicePageHeaderTitle );

	// envit Title Alignment
    $serviceTitleAligment = ( isset( $_POST['service-title-alignment'] ) ?  $_POST['service-title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-title-alignment', $serviceTitleAligment );
	
	// envit Title Padding Top
    $serviceTitlePaddingTop = ( isset( $_POST['service-title-padding-top'] ) ?  $_POST['service-title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-title-padding-top', $serviceTitlePaddingTop );
	
	// envit Title Padding Bottom
    $serviceTitlePaddingBottom = ( isset( $_POST['service-title-padding-bottom'] ) ?  $_POST['service-title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-title-padding-bottom', $serviceTitlePaddingBottom );

	// envit Meta Team Module
	
	// envit Team Image
	$teamInnerMain = ( isset( $_POST['team-header-image'] ) ?  $_POST['team-header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-header-image', $teamInnerMain );
	
	// envit Hide Page title
	$teamHidePageTitle = ( isset( $_POST['team-hide-page-title'] ) ?  $_POST['team-hide-page-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-hide-page-title', $teamHidePageTitle );
	
	// envit Hide Breadcrumb
	$teamHideBreadcrumb = ( isset( $_POST['team-hide-breadcrumb'] ) ?  $_POST['team-hide-breadcrumb']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-hide-breadcrumb', $teamHideBreadcrumb );
		
	// envit Page Header Title
    $teamPageHeaderTitle = ( isset( $_POST['team-header-title'] ) ?  $_POST['team-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-header-title', $teamPageHeaderTitle );

	// envit Title Alignment
    $teamTitleAligment = ( isset( $_POST['team-title-alignment'] ) ?  $_POST['team-title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-title-alignment', $teamTitleAligment );
	
	// envit Title Padding Top
    $teamTitlePaddingTop = ( isset( $_POST['team-title-padding-top'] ) ?  $_POST['team-title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-title-padding-top', $teamTitlePaddingTop );
	
	// envit Title Padding Bottom
    $teamTitlePaddingBottom = ( isset( $_POST['team-title-padding-bottom'] ) ?  $_POST['team-title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-title-padding-bottom', $teamTitlePaddingBottom );

	// envit Meta Post Module
	
	// envit Post Image
	$postInnerMain = ( isset( $_POST['post-header-image'] ) ?  $_POST['post-header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-header-image', $postInnerMain );
	
	// envit Hide Page title
	$postHidePageTitle = ( isset( $_POST['post-hide-page-title'] ) ?  $_POST['post-hide-page-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-hide-page-title', $postHidePageTitle );
	
	// envit Hide Breadcrumb
	$postHideBreadcrumb = ( isset( $_POST['post-hide-breadcrumb'] ) ?  $_POST['post-hide-breadcrumb']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-hide-breadcrumb', $postHideBreadcrumb );
		
	// envit Page Header Title
    $postHeaderTitle = ( isset( $_POST['post-header-title'] ) ?  $_POST['post-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-header-title', $postHeaderTitle );

	// envit Title Alignment
    $postTitleAligment = ( isset( $_POST['post-title-alignment'] ) ?  $_POST['post-title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-title-alignment', $postTitleAligment );
	
	// envit Title Padding Top
    $postTitlePaddingTop = ( isset( $_POST['post-title-padding-top'] ) ?  $_POST['post-title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-title-padding-top', $postTitlePaddingTop );
	
	// envit Title Padding Bottom
    $postTitlePaddingBottom = ( isset( $_POST['post-title-padding-bottom'] ) ?  $_POST['post-title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-title-padding-bottom', $postTitlePaddingBottom );

	// envit Meta Shop Module
	
	// envit Product Image
	$productInnerMain = ( isset( $_POST['product-header-image'] ) ?  $_POST['product-header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'product-header-image', $productInnerMain );
	
	// envit Hide Page title
	$productHidePageTitle = ( isset( $_POST['product-hide-page-title'] ) ?  $_POST['product-hide-page-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'product-hide-page-title', $productHidePageTitle );
	
	// envit Hide Breadcrumb
	$productHideBreadcrumb = ( isset( $_POST['product-hide-breadcrumb'] ) ?  $_POST['product-hide-breadcrumb']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'product-hide-breadcrumb', $productHideBreadcrumb );
		
	// envit Page Header Title
    $productHeaderTitle = ( isset( $_POST['product-header-title'] ) ?  $_POST['product-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'product-header-title', $productHeaderTitle );

	// envit Title Alignment
    $productTitleAligment = ( isset( $_POST['product-title-alignment'] ) ?  $_POST['product-title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'product-title-alignment', $productTitleAligment );
	
	// envit Title Padding Top
    $productTitlePaddingTop = ( isset( $_POST['product-title-padding-top'] ) ?  $_POST['product-title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'product-title-padding-top', $productTitlePaddingTop );
	
	// envit Title Padding Bottom
    $productTitlePaddingBottom = ( isset( $_POST['product-title-padding-bottom'] ) ?  $_POST['product-title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'product-title-padding-bottom', $productTitlePaddingBottom );
	
}
add_action( 'save_post', 'wdm_save_meta_box_data_unit' );


// Tmc Post Type Rewrite subplugin
add_action( 'admin_menu', 'tmc_post_types_options_menu' );

if( ! function_exists( 'tmc_post_types_options_menu' ) ){
	function tmc_post_types_options_menu(){
		add_options_page( __('TMC Post Types', TMC_POST_TYPE), __('TMC Post Types', TMC_POST_TYPE), 'manage_options', 'tmc_post_types', 'tmc_post_types_options' );
	}
}

if( ! function_exists( 'tmc_post_types_options' ) ){
	function tmc_post_types_options(){

		if ( ! empty( $_POST['tmc_post_types_options'] ) ) {
			update_option( 'tmc_post_types_options', $_POST['tmc_post_types_options'] );
		}

		$options_meta = get_option('tmc_post_types_options');

		$tmcPostTypesOptions = array(

			'team' => array(
			'title' => __( 'Team', TMC_POST_TYPE ),
			'rewrite' => 'team'
			),
			
			'clients' => array(
				'title' => __( 'Clients', TMC_POST_TYPE ),
				'rewrite' => 'clients'
			),
			'gallery' => array(
				'title' => __( 'Gallery', TMC_POST_TYPE ),
				'rewrite' => 'gallery'
			),
				
			'services' => array(
				'title' => __( 'Services', TMC_POST_TYPE ),
				'rewrite' => 'services'
			),	
			'testimonials' => array(
				'title' => __( 'Testimonials', TMC_POST_TYPE ),
				'rewrite' => 'testimonials'
			),
		);

		$options_meta = wp_parse_args( $options_meta, $tmcPostTypesOptions );
		
		$content = '';

		$content .= '
			<div class="tmcposttype">
		        <h2>' . __( 'TMC Post Type Settings', TMC_POST_TYPE ) . '</h2>

		        <form method="POST" action="">
		            <table class="form-table">';
						foreach ($tmcPostTypesOptions as $key => $value){
							$content .= '
								<tr valign="top">
									<th scope="row">
										<label for="'.$key.'_title">' . __( 'Module Name:', TMC_POST_TYPE ) . '</label>
									</th>
									<td>
				                        <input type="text" id="'.$key.'_title" name="tmc_post_types_options['.$key.'][title]" value="' . $options_meta[$key]['title'] . '"  size="25" />
				                    </td>
								</tr>
								
				                <tr valign="top">
				                    <th scope="row">
				                        <label for="'.$key.'_rewrite">' . __( 'Slug:', TMC_POST_TYPE ) . '</label>
				                    </th>
				                    <td>
				                        <input type="text" id="'.$key.'_rewrite" name="tmc_post_types_options['.$key.'][rewrite]" value="' . $options_meta[$key]['rewrite'] . '"  size="25" />
				                    </td>
				                </tr>
				                <tr valign="top"><th scope="row"></th></tr>
			                ';
						}
		 $content .='</table>
		            <p>' . __( "NOTE: After you change the rewrite field values, you'll need to refresh permalinks under Settings -> Permalinks", TMC_POST_TYPE ) . '</p>
		            <br/>
		            <p>
						<input type="submit" value="' . __( 'Save settings', TMC_POST_TYPE ) . '" class="button-primary"/>
					</p>
		        </form>
		    </div>
		';
		
		echo $content;
	}
}





/* ------------------------------------------------------------------------ */
/* Custom function for envit's own CSS
/* ------------------------------------------------------------------------ */

function envit_metabox_style() {
    $plugin_url =  plugins_url('', __FILE__);
    wp_enqueue_style( 'style', $plugin_url . '/css/style.css', null, null, 'all' );
}

add_action( 'admin_enqueue_scripts', 'envit_metabox_style' );



?>