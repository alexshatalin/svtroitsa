<?php
	$atts = vc_map_get_attributes( 'envit_services', $atts );
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
	$args = array(
				'post_type' => 'services',
				'post_status' => 'publish',
				'order'          => $order,
				'posts_per_page' => $number
			);
    $the_service = new WP_Query( $args );
	
	if ( $the_service->have_posts() ) :
	if($layout == 'grid_image'){
		$output .= '<div class="welcome_subsection '. esc_attr($el_class) .'">
			   <div class="row">';
	
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		if($count == $column){
			$emptyClass = 'emptyspace-null';
		}else{
			$emptyClass = 'empty-space-sm-30';
		}
			$output .= '<div class="'.esc_attr($col_class).'">
							<div class="custom-hover">
								'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
							</div>
							<div class="empty-space-mb-40"></div>
							<h4 class="tt-featured-title"><a href="'.get_the_permalink().'" class="titleLink">'.get_the_title().'</a></h4>
								<div class="simple-text">
							<p>'.get_the_excerpt().'</p>
							</div>
							<div class="'.esc_attr($emptyClass).'"></div>
						</div>';
			endwhile;
		$output .= '</div></div>'; 
	}else{
		$output .= '<div class="row '. esc_attr($el_class) .'">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$excerpt= get_the_excerpt();
		$iconClass =  get_post_meta(get_the_ID(), '_envit_services_icon', true );
		if($iconClass != 'flaticon-arrows')
			$varClass = 'icon2';
		else
		$varClass = '';
		if($count <= $column){
			$emptyClass = 'emptyspace mb120 sm60 xs30';
		}else{
			$emptyClass = 'emptyspace sm60 xs30';
		}

			$output .= '<div class="'.esc_attr($col_class).'">
						   <div class="single-service">
						   <div class="icon '.esc_attr($varClass).'">
						   <i class="'.esc_attr($iconClass).'"></i>
						   </div>
						   <div class="empty-space-mb-30"></div>
						   <div class="text">
						   <h4 class="tt-featured-title"><a href="'.get_the_permalink().'" class="titleLink">'.get_the_title().'</a></h4>
						   <div class="simple-text">
						   <p>'.substr(esc_attr($excerpt), 0, 101).'</p>
						   </div>
						   
						   </div>
						   </div>
							<div class="'.esc_attr($emptyClass).'"></div>
						</div>';
			endwhile;
		$output .= '</div>';
	}
		else:
			$output .= esc_html( 'Sorry, there is no service under your selected page.', 'envit' );
	endif;
	
	wp_reset_postdata();
	echo $output;
?>