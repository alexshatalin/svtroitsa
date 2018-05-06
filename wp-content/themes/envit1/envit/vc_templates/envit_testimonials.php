<?php
	$atts = vc_map_get_attributes( 'envit_testimonials', $atts );
	extract ($atts);	
	$output = null;
	$count  = 0;
	$args = array(
				'post_type' => 'testimonials',
				'post_status' => 'publish',
				'order'          => $order,
				'posts_per_page' => $number
			);
    $the_service = new WP_Query( $args );
	
	if ( $the_service->have_posts() ) :
			if($layout == 'carousel'){
			$output .= '<div id="tcb-testimonial-carousel" class="carousel slide '. esc_attr($el_class) .'" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#tcb-testimonial-carousel" data-slide-to="0" class="active"></li>
								<li data-target="#tcb-testimonial-carousel" data-slide-to="1"></li>
								<li data-target="#tcb-testimonial-carousel" data-slide-to="2"></li>
							</ol><div class="carousel-inner">';
			
			while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			
			$testimonialDes =  get_post_meta(get_the_ID(), 'envit_testimonial_designation', true );
			if($count == 1)
				$varClass = 'active';
			else
			$varClass = '';
		
				$output .= '<div class="item '.esc_attr($varClass).'">
								<div class="row">
									<div class="col-xs-12">
									   <figure class="clearfix">
									   <div class="row">
										   <div class="col-md-2 col-sm-2 col-xs-12">
										   <div class="icon">
										 <i class="flaticon3-left"></i>
										 </div>
										   </div>
										   <div class="col-md-10 col-sm-10 col-xs-12">
												<div class="caption">
													<p class="text-brand lead no-margin">'.get_the_excerpt().'</p>
													 <div class="empty-space-mb-30"></div>
													<div class="row">
													<div class="col-md-3">
														'.get_the_post_thumbnail(get_the_ID(), 'full').'
													</div>
												   <div class="col-md-9">
												   <h4 class="name">'.get_the_title().',<span> '.esc_attr($testimonialDes).'</span></h4>
												   </div>
												</div>
												</div>
										   </div>
											</div>
									   </figure>
									</div>
								</div>
							</div>';
			endwhile;

			$output .= '</div>
							<a class="left carousel-control" href="#tcb-testimonial-carousel" data-slide="prev"> <span class="fa fa-angle-left"></span></a>
							<a class="right carousel-control" href="#tcb-testimonial-carousel" data-slide="next"> <span class="fa fa-angle-right"></span></a>	
						</div>'; 
		}else{
			$output .= '<div class="row '. esc_attr($el_class) .'">';
			
			while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			$testimonialDes =  get_post_meta(get_the_ID(), 'envit_testimonial_designation', true );
			if($count % 2 != 0)
				$varClass = 'border';
			else
				$varClass = '';
		
				$output .= '<div class="col-md-6">
                         <div class="row">
						     <div class="col-md-2 col-sm-2 col-xs-12">
							 <div class="icon">
							 <i class="flaticon3-left"></i>
							 </div>
							 </div>
                               <div class="col-md-10 col-sm-10 col-xs-12">
                                    <div class="caption '.esc_attr($varClass).'">
                                        <p class="text-brand lead no-margin">'.get_the_excerpt().'</p>
										 <div class="empty-space-mb-30"></div>
										<div class="row">
										<div class="col-md-2">
                                       '.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
									   </div>
									   <div class="col-md-10">
                                       <h4 class="name">'.get_the_title().',<span> '.esc_attr($testimonialDes).'</span></h4>
									   </div>
									    </div>
                                    </div>
                               </div>
							    </div></div>';
			endwhile;

			$output .= '</div>'; 
		}
		else:
		$output .= esc_html( 'Sorry, there is no Testimonial under your selected page.', 'envit' );
	endif;
	
	wp_reset_postdata();
	echo $output;
?>