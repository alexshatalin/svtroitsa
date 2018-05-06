<?php
	$atts = vc_map_get_attributes( 'envit_event', $atts );
	extract ($atts);
	if (is_plugin_active('the-events-calendar/the-events-calendar.php')):	
	$output = null;
	$count  = 0;
	
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
	
	$args = array(
				'post_type' => 'tribe_events',
				'post_status' => 'publish',
				'order'          => $order,
				'posts_per_page' => $number
			);
    $the_service = new WP_Query( $args );
	
	if ( $the_service->have_posts() ) :
		if($layout == 'list')
		{
			$output .= '<div class="row '. esc_attr($el_class) .'">';
			while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			if($count == $number)
			{
				$emptyClass = 'emptyspace-null';
			}
			else
			{
				$emptyClass = 'empty-space-mb-40';
			}
			$excerpt= get_the_excerpt();
			if($count == 1){
				$output .= '<div class="col-md-6 leftEvent">
								<div class="custom-hover">
									'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
								</div>
								<div class="empty-space-mb-40"></div>
								<h4 class="tt-featured-title"><a href="'.get_the_permalink().'" class="titleLink">'.get_the_title().'</a></h4>
								<div class="tt-info">
								<div class="time">
								   <div class="simple-text">
									 <p>'.esc_html('Start on: ','envit').''.tribe_get_start_date($post, false, $format = 'g:i A') . '</p>
								   </div>
								</div>
								<div class="addres">
								   <div class="simple-text">
									 <p>'.tribe_get_address().'</p>
								   </div>
								</div>
								</div>
								<div class="simple-text">
									 <p>'.get_the_excerpt().'</p>
								</div>   
							</div>	
							<div class="empty-space marg-xs-b20"></div><div class="col-md-6">';
			}else{
				$output .= '<div class="right-section">
									<div class="blank">
									<ul class="date">
										<li class="tt-title font32 white">'.tribe_get_start_date($post, false, $format = 'd' ).'</li>
										<li class="tt-title font16 white">'.tribe_get_start_date($post, false, $format = 'M' ).'</li>
									</ul>
									</div>
									<div class="content">
									<h4 class="tt-featured-title"><a href="'.get_the_permalink().'" class="titleLink">'.get_the_title().'</a></h4>
									<div class="tt-info">
										<div class="time">
											<div class="simple-text">
												<p>'.esc_html('Start on: ','envit').''.tribe_get_start_date($post, false, $format = 'g:i A') . '</p>
											</div>
										</div>
										<div class="addres">
										   <div class="simple-text">
											 <p>'.tribe_get_address().'</p>
										   </div>
										</div>
									</div>
									<div class="simple-text">
										 <p>'.substr(esc_attr($excerpt), 0, 92).'</p>
									</div>
									</div>
								</div>	
								<div class="'.esc_attr($emptyClass).'"></div>';
			}
			endwhile;

			$output .= '</div>
							</div>';
		}
		else
		{
			$output .= '<div class="row '. esc_attr($el_class) .'">';
			while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
				$output .= '<div class="'.esc_attr($col_class).' single-event col-mb">
									<div class="image custom-hover">
									   '.get_the_post_thumbnail(get_the_ID(), 'envit-image-570x240-croped', array('class' => 'img-responsive')).'
									</div>
									<div class="date">
								<h5>'.tribe_get_start_date($post, false, $format = 'd' ).'</h5>
								<span>'.tribe_get_start_date($post, false, $format = 'M' ).'</span>
								</div>
									<div class="event-content">
									<h4 class="tt-featured-title"><a href="'.get_the_permalink().'" class="titleLink">'.get_the_title().'</a></h4>
									
									<div class="tt-info">
								 <div class="time">
								   <div class="simple-text">
									 <p>'.esc_html('Start on: ','envit').''.tribe_get_start_date($post, false, $format = 'g:i A') . '</p>
								   </div>
								</div>
								
								<div class="addres">
								   <div class="simple-text">
									 <p>'.tribe_get_address().'</p>
								   </div>
								</div>
								</div>
								
								<div class="simple-text">
								<p>'.get_the_excerpt().'</p>
								</div>
								<div class="button">
									<a href="'.get_the_permalink().'" class="c-btn event_btn">'.esc_attr($more_details_text).'</a>
								</div>
								</div>
							</div>';
			endwhile;

			$output .= '</div>';
		}
		else:
			$output .= esc_html( 'Sorry, there is no event under your selected page.', 'envit' );
	endif;
	endif;
	
	wp_reset_postdata();
	echo $output;
?>