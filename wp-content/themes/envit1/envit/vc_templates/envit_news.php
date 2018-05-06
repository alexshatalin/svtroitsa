<?php
	$atts = vc_map_get_attributes( 'envit_news', $atts );
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
	
		$output .= '<div class="row '. esc_attr($el_class) .'">';
	
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		if($count == $column){
			$emptyClass = 'emptyspace-null';
		}else{
			$emptyClass = 'empty-space-sm-30';
		}
			$output .= '<div class="'.esc_attr($col_class).'">
							<div class="news_box">
								<div class="image custom-hover">
									'.get_the_post_thumbnail(get_the_ID(), 'envit-image-370x202-croped', array('class' => 'img-responsive')).'
								</div>
								<div class="date">
									<h5>'.get_the_date("d").'</h5>
									<span>'.get_the_date("M").'</span>
								</div>
								<div class="text">
									<h4 class="tt-news-title"><a href="'.get_the_permalink().'" class="titleLink">'.get_the_title().'</a></h4>
									<div class="simple-text">
										<p>'.get_the_excerpt().'</p>
									</div>
									<div class="tt-news-info">
										<div class="tt-news-label"><i class="fa fa-user" aria-hidden="true"></i><a href="'.get_the_permalink().'">'.get_the_author().'</a></div>
									   
										<div class="tt-news-label"><i class="fa fa-comments-o" aria-hidden="true"></i>'.esc_html('Comments:', 'envit').' <a href="'.get_the_permalink().'">'.get_comments_number( get_the_ID() ).'</a></div>
									</div>
								</div>
							</div>
							<div class="'.esc_attr($emptyClass).'"></div>
						</div>';
		endwhile;

		$output .= '</div>'; 
		else:
			$output .= esc_html( 'Sorry, there is no service under your selected page.', 'envit' );
	endif;
	
	wp_reset_postdata();
	echo $output;
?>