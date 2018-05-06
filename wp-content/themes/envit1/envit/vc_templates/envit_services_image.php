<?php
	$atts = vc_map_get_attributes( 'envit_services_image', $atts );
	extract ($atts);
	$output = null;
	$col_class = $thumbnail = '';
	if ( $column == 2 ) {
		$col_class = "grid-sm-6";
	} elseif ( $column == 3 ){
		$col_class = "grid-sm-6 grid-md-4";
	} elseif ( $column == 4 ) {
		$col_class = "grid-sm-6 grid-md-3";
	} else {
		$col_class = "grid-sm-6 grid-md-4";
	}
	$count  = 0;
	$postType = explode(",",$posttype);
	$args = array(
			'post_type' => $postType,
			'post_status' => 'publish',
			'order'          => $order,
			'posts_per_page' => $number
		);
    $the_service = new WP_Query( $args );
	if ( $the_service->have_posts() ) :
	
	$output .= '<div class="welcome_bottomsection">
	<div class="row">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		if($count % 2 != 0){
			$imageSrc = wp_get_attachment_url( $postimageone );
		}else{
			$imageSrc = wp_get_attachment_url( $postimagetwo );
		}
		if($count == $column){
			$emptyClass = 'emptyspace-null';
		}else{
			$emptyClass = 'empty-space-sm-30';
		}
		$output .= '<div class="'.esc_attr($col_class).' col-wp-12">
					<div class="icon">
						<img src="'.esc_url($imageSrc).'" alt="">
					</div>
					<div class="text">
						<h4 class="tt-featured-title"><a href="'.get_the_permalink().'" class="titleLink">'.get_the_title().'</a></h4>
						<div class="simple-text">
							<p>'.get_the_excerpt().'</p>
						</div>
					</div><div class="'.esc_attr($emptyClass).'"></div>
				</div>';
		endwhile;
		
		$output .= '</div></div>';
		
		else:
			$output .= esc_html( 'Sorry, there is no services under your selected page.', 'envit' );
	endif;
	wp_reset_postdata();
	echo $output;
?>