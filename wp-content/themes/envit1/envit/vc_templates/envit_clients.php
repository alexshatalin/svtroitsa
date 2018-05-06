<?php
	$atts = vc_map_get_attributes( 'envit_clients', $atts );
	extract ($atts);	
	$output = null;
	$count  = 0;
	if( $categoriesname == 'All' || $categoriesname == '' )
	{		
		$taxonomy = '';
	} 
	else 
	{
		$taxonomy = 'tax_query';
	}
	$args = array(
				'post_type' => 'clients',
				'post_status' => 'publish',
				'order'          => $order,
				'posts_per_page' => $number,
				$taxonomy => array(
										array(
											'taxonomy' => 'clients_category',
											'field' => 'name',
											'terms' => $categoriesname
										)
									),
			);
    $the_service = new WP_Query( $args );
	if ( $the_service->have_posts() ) :
	if ( $layout == 'style_one' ) 
	{
		$output .= '<div class="row '. esc_attr($el_class) .'">
						<div class="col-md-12">
							<div class="large-12 columns">
								<div class="owl-two owl-carousel owl-theme">';
	
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			$output .= '<div class="item">
						   '.get_the_post_thumbnail(get_the_ID(), 'full').'
						</div>';
		endwhile;

		$output .= '</div>
						</div>
							</div>
								</div>'; 
	}
	elseif($layout == 'style_two') 
	{
		$output .= '<div class="row '. esc_attr($el_class) .'">
						<div class="col-md-12">
							<div class="large-12 columns">
								<div class="owl-two owl-carousel owl-theme">';
	
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			$output .= '<div class="item">
						   '.get_the_post_thumbnail(get_the_ID(), 'full').'
						</div>';
		endwhile;

		$output .= '</div>
						</div>
							</div>
								</div>';		
	}
		else
			$output .= esc_html( 'Sorry, there is no client under your selected page.', 'envit' );
	endif;
	
	wp_reset_postdata();
	echo $output;
?>