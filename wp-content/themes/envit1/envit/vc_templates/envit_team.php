<?php
	$atts = vc_map_get_attributes( 'envit_team', $atts );
	extract ($atts);
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
	$output = '';
	$count  = 0;

    if ( $carousel_autoplay == 'yes' ) {
        $carousel_autoplay = 'true';
    } else {
        $carousel_autoplay = 'false';
    }

    if ( $carousel_autoplay_speed == '' ) {
        $carousel_autoplay_speed = '3000';
    }

    if ( $carousel_speed == '' ) {
        $carousel_speed = '300';
    }
	$args = array(
				'post_type' => 'team',
				'post_status' => 'publish',
				'order'          => $order,
				'posts_per_page' => $number
			);			
    $the_service = new WP_Query( $args );
	$carousel_class = '';
	if ( $layout == 'carousel' ) {
		$carousel_class = 'owl-three';
			$output1 = '
				jQuery(document).ready(function(){
					"use strict";
					jQuery(".'. esc_js($carousel_class) .'").owlCarousel({
						loop: true,
						margin: 10,
						responsiveClass: true,
						autoplaySpeed: '. esc_js($carousel_autoplay_speed) .',
						speed: '. esc_js($carousel_speed) .',
						responsive: {
						  0: {
							items: 1,
							nav: true,
							autoplay:'. esc_js($carousel_autoplay) .',
						  },
						  600: {
							items: 2,
							nav: true,
							autoplay:'. esc_js($carousel_autoplay) .',
						  },
						  991: {
							items: 3,
							nav: true,
							autoplay:'. esc_js($carousel_autoplay) .',
						  },
						  1200: {
							items: 4,
							nav: true,
							loop: true,
							margin: 20,
							autoplay:'. esc_js($carousel_autoplay) .',
						  }
						}
					  });	
					 jQuery( ".owl-prev").html("<i class=\"fa fa-angle-left\"></i>");
					 jQuery( ".owl-next").html("<i class=\"fa fa-angle-right\"></i>");
				});';
	}
	wp_add_inline_script('envit-custom', $output1 );

	if ( $the_service->have_posts() ) :
		$output .= '<div class="large-12 columns '. esc_attr($el_class) .'">
					<div class="owl-three owl-carousel owl-theme">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$facebook = get_post_meta( get_the_ID(), '_envit_social_facebook', true ); 
		$twitter = get_post_meta( get_the_ID(), '_envit_social_twitter', true ); 
		$google_plus = get_post_meta( get_the_ID(), '_envit_social_google_plus', true ); 
		$linkedin = get_post_meta( get_the_ID(), '_envit_social_linkedin', true );
		$designation =  get_post_meta(get_the_ID(), '_envit_member_designation', true );
			$output .= '<div class="item">
						  <div class="caption-style-2">
							<div class="team-content">
							 <div class="image">
								'.get_the_post_thumbnail(get_the_ID(), 'full').'
							</div>
							<div class="content">
							<h5>'.get_the_title().'</h5>
							<p>'.esc_attr($designation).'</p>
							</div>
							<div class="caption">
								<div class="blur"></div>
								<div class="caption-text">
									<h5>'.get_the_title().'</h5>
									<p>'.esc_attr($designation).'</p>
									<ul class="nav footer-social">';
									if(!empty($facebook)):
										$output .= '<li><a href="'.wp_kses_post($facebook).'"><i class="fa fa-facebook"></i></a></li>';
									endif;
									if(!empty($twitter)):
										$output .= '<li><a href="'.wp_kses_post($twitter).'"><i class="fa fa-twitter"></i></a></li>';
									endif;
									if(!empty($google_plus)):
										$output .= '<li><a href="'.wp_kses_post($google_plus).'"><i class="fa fa-google-plus"></i></a></li>';
									endif;
									if(!empty($linkedin)):
										$output .= '<li><a href="'.wp_kses_post($linkedin).'"><i class="fa fa-linkedin"></i></a></li>';
									endif;
								$output .= '</ul>
								</div>
							</div>
						</div>
						</div>
						</div>';
		endwhile;
			$output .= '</div></div>';
		else:
			$output .= esc_html__( 'Sorry, there is no Team under your selected page.', 'envit' );
	endif;
		wp_reset_postdata();
		echo $output;
	?>