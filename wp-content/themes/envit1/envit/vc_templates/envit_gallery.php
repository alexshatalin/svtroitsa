<?php
	$atts = vc_map_get_attributes( 'envit_gallery', $atts );
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

    if ( $carousel_autoplay == 'yes' ) {
        $carousel_autoplay = 'true';
    } else {
        $carousel_autoplay = 'false';
    }
	
	$postType = explode(",",$posttype);
	$args = array(
				'post_type' => $postType,
				'post_status' => 'publish',
				'order'          => $order,
				'posts_per_page' => $number
			);
	$args_c = array(
				'type'                     => 'gallery',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'gallery_category',
				'pad_counts'               => false 
			);	
    $the_service = new WP_Query( $args );
	$categories = get_categories( $args_c );
	if ( $the_service->have_posts() ) :
	if ( $layout == 'filter' ) {
					$output .= '<ul class="portfolio-sorting list-inline">
									<li><a href="#" class="active" data-group="all">'.esc_html__('All', 'envit').'</a></li>';
				
									foreach ($categories as $category)	{
									$cat = str_replace(" ","_",$category->name);  
									$output .= ' <li><a href="#" data-group="'.esc_attr($cat).'">'.esc_attr($category->name).'</a></li>';
								} 
	
								$output .= '</ul>';					
					
		$output .= '<div class="row '. esc_attr($el_class) .'"><ul class="portfolio-items list-unstyled" id="grid">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$lightimage = get_the_post_thumbnail_url( get_the_ID(), 'full');
		$terms = get_the_terms (get_the_ID(), 'gallery_category');
		$arrCat = wp_list_pluck($terms, 'name'); 	
		if(is_array($arrCat)){
			foreach ($arrCat as $catname)	{
				$catname = str_replace(" ","_",$arrCat);
			}	
		}

		for($i=0; $i<count($catname); $i++){
			$j = $i + 1 ;
			if($j<count($catname)){
				$endRem = ',';
			}
			$expCat .= '"'.$catname[$i].'"'.esc_attr($endRem).'';
			$endRem = '';
		}

			$output .= '
				<li class="'.esc_attr($col_class).' col-xs-6 isotopeSelector" data-groups=\'['.esc_attr($expCat).']\'>
					<figure class="portfolio-item">
						'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
					<div class="overlay-background">
                      <div class="inner-overlay">
                        <div class="inner-overlay-content with-icons"><a data-title="'.get_the_title().'" href="'.esc_url($lightimage).'" class="lightbox lens_icon">
						<i class="icon icon-Search"></i>
					</a></div>
                      </div>
                    </div>
					</figure>
				</li>'; 
				$expCat = '';
		endwhile;
		$output .= '</ul></div>';
		
	}elseif($layout == 'cobbies'){
		$output .= '<div class="cobbies '. esc_attr($el_class) .'">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$lightimage =  get_post_meta(get_the_ID(), '_envit_masonry_gallery', true );
				if($count < 5){
					if($count == 1){
							$output .= '<div class="row '. esc_attr($el_class) .'"><div class="col-md-3 col-sm-6 col-xs-6 isotopeSelector">
						  <figure>
							<img src="'.wp_get_attachment_url($lightimage).'" class="img-responsive" alt="">
						   <div class="overlay-background">
							  <div class="inner-overlay">
								<div class="inner-overlay-content with-icons"><a data-title="'.get_the_title().'" href="'.wp_get_attachment_url($lightimage).'" class="lightbox lens_icon">
								<i class="icon icon-Search"></i>
							</a></div>
							  </div>
							</div>
							</figure>
						 </div>';
					}
					if($count == 2 || $count == 3){
						if($count == 2){
							$output .= '<div class="col-md-3 col-sm-6 col-xs-6 isotopeSelector">
									 <div class="row">
									 <div class="col-md-12"> <figure>
										<img src="'.wp_get_attachment_url($lightimage).'" class="img-responsive" alt="">
									   <div class="overlay-background">
										  <div class="inner-overlay">
											<div class="inner-overlay-content with-icons"><a data-title="'.get_the_title().'" href="'.wp_get_attachment_url($lightimage).'" class="lightbox lens_icon">
											<i class="icon icon-Search"></i>
										</a></div>
										  </div>
										</div>
										</figure>';
						}else{
						$output .= '<div class="spacemb">
									  <figure>
										<img src="'.wp_get_attachment_url($lightimage).'" class="img-responsive" alt="">
									   <div class="overlay-background">
										  <div class="inner-overlay">
											<div class="inner-overlay-content with-icons"><a data-title="'.get_the_title().'" href="'.wp_get_attachment_url($lightimage).'" class="lightbox lens_icon">
											<i class="icon icon-Search"></i>
										</a></div>
										  </div>
										</div>
										
										</figure>
										</div></div>
								</div>
							 </div>';
						}
					}
					if($count == 4){
						$output .= '<div class="col-md-6 col-sm-12 col-xs-12 isotopeSelector space">
							  <figure>
								<img src="'.wp_get_attachment_url($lightimage).'" class="img-responsive" alt="">
							   <div class="overlay-background">
								  <div class="inner-overlay">
									<div class="inner-overlay-content with-icons"><a data-title="'.get_the_title().'" href="'.wp_get_attachment_url($lightimage).'" class="lightbox lens_icon">
									<i class="icon icon-Search"></i>
								</a></div>
								  </div>
								</div>
								
								</figure>
						 </div></div><div class="row">';
					}
				}else{
					if($count == 5){
						$output .='<div class="col-md-6 col-sm-12 col-xs-12 isotopeSelector">
									  <figure>
										<img src="'.wp_get_attachment_url($lightimage).'" class="img-responsive" alt="">
									   <div class="overlay-background">
										  <div class="inner-overlay">
											<div class="inner-overlay-content with-icons"><a data-title="'.get_the_title().'" href="'.wp_get_attachment_url($lightimage).'" class="lightbox lens_icon">
											<i class="icon icon-Search"></i>
										</a></div>
										  </div>
										</div>
									  </figure>
									</div>';
					}else{
						$output .='<div class="col-md-3 col-sm-6 col-xs-6 isotopeSelector">
									<figure>
										<img src="'.wp_get_attachment_url($lightimage).'" class="img-responsive" alt="">
									   <div class="overlay-background">
										  <div class="inner-overlay">
											<div class="inner-overlay-content with-icons"><a data-title="'.get_the_title().'" href="'.wp_get_attachment_url($lightimage).'" class="lightbox lens_icon">
											<i class="icon icon-Search"></i>
										</a></div>
										  </div>
										</div>
										</figure>
								 </div>';
					}
				}
			
		endwhile;

		$output .= '</div></div>';

	}elseif($layout == 'text'){
		$output .= '<div class="row '. esc_attr($el_class) .'">';
		if($icon_image == ''){
			$icon_image = get_template_directory_uri() . '/assets/images/allmix/icon.png';
		}else{
			$icon_image = wp_get_attachment_url( $icon_image );
		}
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$lightimage = get_the_post_thumbnail_url( get_the_ID(), 'full');
			$output .= '<div class="'.esc_attr($col_class).' col-xs-6 isotopeSelector">
							 <figure class="caption-style-2 captiongallery">
							'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
							  <div class="caption">
								  <div class="blur"></div>
							   <div class="caption-text">
								 <p>'.get_the_excerpt().'</p>
							   </div>
							  </div>
						   <div class="overlay-background">
							  <div class="inner-overlay">
								<div class="inner-overlay-content with-icons"><a data-title="'.get_the_title().'" href="'.esc_url($lightimage).'" class="lightbox lens_icon">
								<div class="icon">
								<img src="'.esc_attr($icon_image).'" alt="">
								</div>
							</a></div>
							  </div>
								
							</div>
							</figure>
						 </div>';

		endwhile;

		$output .= '</div>';
	}else{
		$output .= '<div class="row '. esc_attr($el_class) .'">';
		
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
		$lightimage = get_the_post_thumbnail_url( get_the_ID(), 'full');
			$output .= '<div class="'.esc_attr($col_class).' col-xs-6 isotopeSelector">
							<figure>
								'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
								<div class="overlay-background">
								  <div class="inner-overlay">
									<div class="inner-overlay-content with-icons"><a data-title="'.get_the_title().'" href="'.esc_url($lightimage).'" class="lightbox lens_icon">
									<i class="icon icon-Search"></i>
								</a></div>
								</div>
								</div>
							</figure>
						</div>';

		endwhile;

		$output .= '</div>';
	}
		else:
			$output .= esc_html( 'Sorry, there is no gallery under your selected page.', 'envit' );
	endif;
	
	wp_reset_postdata();
	echo $output;
	?>