<?php
	$atts = vc_map_get_attributes( 'envit_single_section', $atts );
	extract( $atts );
	$output .= '';
	$count  = 0;
	$href = vc_build_link( $link );
	if($layout == 'layout_one')
	{
		$contentBgClr = '';
		if($body_background)
		{
			$contentBgClr = ' style=background:'. esc_attr($body_background).';';
		}
		$output .= '<div class="col-md-4 box '.esc_attr($customcss).'" '.esc_attr($contentBgClr).' >
							<div class="icon">
								<img src=" '.wp_get_attachment_url($main_image).'" alt="">
							</div>
							<h4 class="tt-featured-title">'.esc_attr($main_heading).'</h4>
							<div class="simple-text text-center">
								<p>'.esc_attr($test_description).'</p>
								<a href="'.esc_url($href[url]).'" class="readmore">'.esc_attr($href[title]).'</a>
							</div>	
					</div>';
	}
	elseif($layout == 'layout_two')
	{
		$output .= '<div class="row"><h3 class="tt-title">'.esc_attr($main_heading).'</h3>
						<div class="text-decor"></div>
						  <h4 class="tt-subtitle">'.esc_attr($subtitle_heading).'</h4>
						<div class="simple-text">
							'.wp_kses_post($test_description).'
						</div>	
							<a class="c-btn" href="'.esc_url($href['url']).'">'.esc_attr($href['title']).'</a>
					</div>';
	}
	else
	{
			$output .= '<h3 class="tt-title font28">'.esc_attr($main_heading).'</h3>
						<div class="empty-space-mb-30"></div>
						<div class="row">
							<div class="col-md-7 pr5 col-sm-6 mwidth1">
								<img src="'.wp_get_attachment_url($main_image).'" class="img-responsive img1" alt="">
							</div>
							<div class="col-md-5 col-sm-6 mwidth2">
								<img src="'.wp_get_attachment_url($main_image_other).'" class="img-responsive img2" alt="">
							</div>
						</div>
						<div class="empty-space-mb-30"></div>
						<h4 class="tt-subtitle text-left">'.esc_attr($subtitle_heading).'</h4>
						<div class="simple-text">
							'.wp_kses_post($test_description).'
						</div>';
	}
	wp_reset_postdata();
	echo $output;
?>