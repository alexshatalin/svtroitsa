<?php
	$atts = vc_map_get_attributes( 'envit_causes', $atts );
	extract ($atts);
	if ( $donate_now_text == '' ) 
	{
		$donate_now_text = esc_html('Donate now', 'envit');
	}
	$col_class = $thumbnail = '';
	if ( $column == 2 ) 
	{
		$col_class = "grid-sm-6";
	} 
	elseif ( $column == 3 )
	{
		$col_class = "grid-sm-6 grid-md-4";
	} 
	elseif ( $column == 4 ) 
	{
		$col_class = "grid-sm-6 grid-md-3";
	} 
	else 
	{
		$col_class = "grid-sm-6 grid-md-4";
	}
	$output = '';
	$count  = 0;

    if ( $carousel_autoplay == 'yes' ) 
	{
        $carousel_autoplay = 'true';
    } 
	else 
	{
        $carousel_autoplay = 'false';
    }

    if ( $carousel_autoplay_speed == '' ) 
	{
        $carousel_autoplay_speed = '3000';
    }

    if ( $carousel_speed == '' ) 
	{
        $carousel_speed = '300';
    }
	if( $categoriesname == 'All' || $categoriesname == '' )
	{		
		$taxonomy = '';
	} 
	else 
	{
		$taxonomy = 'tax_query';
	}
	
	$args = array(
				'post_type' => 'campaign',
				'post_status' => 'publish',
				'order'          => $order,
				'posts_per_page' => $number,
				$taxonomy => array(
										array(
											'taxonomy' => 'campaign_category',
											'field' => 'name',
											'terms' => $categoriesname
										)
									),
			);
		
    $the_service = new WP_Query( $args );
	$carousel_class = '';
	if ( $layout == 'carousel' ) {
		$carousel_class = 'owl-one';
			$output1 = '
				jQuery(document).ready(function(){
					"use strict";
					jQuery(".'. esc_js($carousel_class) .' ").owlCarousel({
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
						  1100: {
							items: 3,
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
	if ( $layout == 'carousel' ) 
	{
		$output .= '<div class="large-12 columns '. esc_attr($el_class) .'">
					<div class="owl-one owl-carousel owl-theme">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$campaigndescription = get_post_meta(get_the_ID(), '_campaign_description', true );
		$causegoal = get_post_meta(get_the_ID(), '_campaign_goal', true );
		$campaign_id = '';
		$campaign_id = get_the_ID();
		
		$results = '';
		$results = new stdClass();
		
		$results->amount = false;
		 
		global $wpdb;
		$sql = "SELECT amount FROM wp_charitable_campaign_donations WHERE campaign_id = '$campaign_id' ";
		$results = $wpdb->get_results($sql);
		foreach( $results as $result ) {
			$result->amount;
		}
		$piechart = intval(($result->amount/$causegoal)*100);
		$piechart = sprintf("%02d", $piechart);
		$piechartTemp = $count*10;
			$output .= '<div class="item">
						   <div class="image-box">
									<div class="image custom-hover ">
										'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
									</div>
									<div class="text">
									   <h4 class="tt-featured-title"><a href="'.get_permalink().'" class="titleLink">'.get_the_title().'</a></h4>
									   <div class="simple-text text-center">
										<p>'.esc_attr($campaigndescription).'</p>
									</div>
										<div class="single-progress">
										   <div class="barfiller barfiller'.esc_attr($piechartTemp).'">
												<div class="tipWrap">
													<span class="tip"></span>
												</div>
												<span class="fill" data-percentage="'.esc_attr($piechartTemp).'"></span>
											</div>
											 </div>
										 <div class="button">
										 <a href="'.get_permalink().'" class="c-btn">'.esc_attr($donate_now_text).'</a>
										 </div>
									</div>
								</div>
						</div>		
						';

		endwhile;

		$output .= '</div></div>';
	}
	elseif($layout == 'single')
	{
		$output .= '<div class="row '. esc_attr($el_class) .'">';
		
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$campaigndescription = get_post_meta(get_the_ID(), '_campaign_description', true );
		$causegoal = get_post_meta(get_the_ID(), '_campaign_goal', true );
		$campaign_id = '';
		$campaign_id = get_the_ID();
		
		$results = '';
		$results = new stdClass();
		
		$results->amount = false;
		 
		global $wpdb;
		$sql = "SELECT amount FROM wp_charitable_campaign_donations WHERE campaign_id = '$campaign_id' ";
		$results = $wpdb->get_results($sql);
		foreach( $results as $result ) {
			$result->amount;
		}
		$piechart = intval(($result->amount/$causegoal)*100);
		$piechart = sprintf("%02d", $piechart);		$piechartTemp = $count*10;
			$output .= '<div class="col-md-5">
						'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
						</div><div class="col-md-7"><div class="saveforest">
						<h3 class="tt-title font-36">'.get_the_title().'</h3>
						<div class="simple-text">
						<p>'.esc_attr($campaigndescription).'</p>
						</div>
						<div class="single-progress">
						<div class="barfiller  barfiller'.esc_attr($piechartTemp).'">
						<div class="tipWrap">
						<span class="tip"></span>
						</div>
						<span class="fill" data-percentage="'.esc_attr($piechartTemp).'"></span>
						</div>
						</div>
						<div class="button">
						<a href="'.get_permalink().'" class="c-btn">'.esc_attr($donate_now_text).'</a>
						</div>
						</div></div>';

		endwhile;

		$output .= '</div>';

	}
	elseif($layout == 'single_style_two')
	{
		$output .= '<div class="donate_box3 urgent"><div class="row '. esc_attr($el_class) .'">';
		
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$campaigndescription = get_post_meta(get_the_ID(), '_campaign_description', true );
		$causegoal = get_post_meta(get_the_ID(), '_campaign_goal', true );
		$campaign_id = '';
		$campaign_id = get_the_ID();
		
		$results = '';
		$results = new stdClass();
		
		$results->amount = false;
		 
		global $wpdb;
		$sql = "SELECT amount FROM wp_charitable_campaign_donations WHERE campaign_id = '$campaign_id' ";
		$results = $wpdb->get_results($sql);
		foreach( $results as $result ) {
			$result->amount;
		}
		$piechart = intval(($result->amount/$causegoal)*100);
		$piechart = sprintf("%02d", $piechart);		$piechartTemp = $count*10;
			$output .= '<div class="col-md-5">
						'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
						</div><div class="col-md-7"><div class="saveforest">
						<h3 class="tt-title font-26">'.get_the_title().'</h3>
						<div class="simple-text">
						<p>'.esc_attr($campaigndescription).'</p>
						</div>
						<div class="single-progress">
						<div class="barfiller barfiller7 barfiller'.esc_attr($piechartTemp).'">
						<div class="tipWrap">
						<span class="tip"></span>
						</div>
						<span class="fill" data-percentage="'.esc_attr($piechartTemp).'"></span>
						</div>
						</div>
						<div class="button">
						<a href="'.get_permalink().'" class="c-btn">'.esc_attr($donate_now_text).'</a>
						</div>
						</div></div>';

		endwhile;

		$output .= '</div></div>';

	}
	else
	{
		$output .= '<div class="row '. esc_attr($el_class) .'">';		
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$campaigndescription = get_post_meta(get_the_ID(), '_campaign_description', true );
		$causegoal = get_post_meta(get_the_ID(), '_campaign_goal', true );
		$campaign_id = '';
		$campaign_id = get_the_ID();		
		$results = '';
		$results = new stdClass();		
		$results->amount = false;		 
		global $wpdb;
		$sql = "SELECT amount FROM wp_charitable_campaign_donations WHERE campaign_id = '$campaign_id' ";
		$results = $wpdb->get_results($sql);
		foreach( $results as $result ) {
			$result->amount;
		}
		$piechart = intval(($result->amount/$causegoal)*100);
		$piechart = sprintf("%02d", $piechart);		$piechartTemp = $count*10;
			$output .= '<div class="'.esc_attr($col_class).'">
							<div class="image-box">
								<div class="image">
									'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
								</div>
								<div class="text">
									<h4 class="tt-featured-title"><a href="'.get_permalink().'" class="titleLink">'.get_the_title().'</a></h4>
									<div class="simple-text text-center">
										<p>'.esc_attr($campaigndescription).'</p>
									</div>
									<div class="single-progress">
										<div class="barfiller barfiller'.esc_attr($piechartTemp).'">
											<div class="tipWrap">
												<span class="tip"></span>
											</div>
										<span class="fill" data-percentage="'.esc_attr($piechartTemp).'"></span>
										</div>
									</div>
									<div class="button">
										<a href="'.get_permalink().'" class="c-btn">'.esc_attr($donate_now_text).'</a>
									</div>
								</div>
							</div>
							<div class="emptyspace45"></div>
						</div>';
		endwhile;
		$output .= '</div><div class="emptySpace30"></div>';
	}
		else:
			$output .= esc_html( 'Sorry, there is no Causes under your selected page.', 'envit' );
	endif;
	
	wp_reset_postdata();
	echo $output;
	?>