<?php
	$atts = vc_map_get_attributes( 'envit_custom_section', $atts );
	extract( $atts );
	$output .= '';
	$count  = 0;
	$href = vc_build_link( $link );
	
	if($layout == 'dummy_text_section_one')
	{
		$output .= '<h4 class="tt-subtitle text-center">'.esc_attr($main_heading_one).'</h4>
						<div class="simple-text middle">
						<p>'.esc_attr($paragraph_one).'</p>
					</div>';
	}
	elseif($layout == 'our_campaign_para')
	{
		$output .= '<div class="emptySpace10"></div>
						<div class="simple-text gray width">
							<p>'.esc_attr($paragraph_one).'</p>
						</div>
						<div class="empty-space marg-lg-b50">
					</div>';
	}
	elseif($layout == 'our_mission_block')
	{
		$output .= '<div class="row">
						<div class="col-md-7 pr5 col-sm-6 mwidth1">
							<img class="alignnone size-medium wp-image-153 img-responsive img1" src="'.wp_get_attachment_url($main_image_one).'" alt="" width="300" height="163" />
						</div>
						<div class="col-md-5 col-sm-6 mwidth2">
							<img class="alignnone size-medium wp-image-154 img-responsive img2" src="'.wp_get_attachment_url($main_image_two).'" alt="" width="249" height="163" />
						</div>
					</div>
					<div class="empty-space-mb-30"></div>
						<h4 class="tt-subtitle text-left">'.esc_attr($main_heading_one).'</h4>
					<div class="simple-text">
						<p>'.esc_attr($paragraph_one).'</p>
					</div>';
	}
	elseif($layout == 'newsletter_para')
	{
		$output .= '<div class="simple-text">
						<p>'.esc_attr($paragraph_one).'</p>
					</div>';
	}	
	elseif($layout == 'newsletter_shortcode')
	{
		$output .= '<div class="tt-subscribe">
						'.do_shortcode( '[mc4wp_form id="'.esc_attr($newsletter_form_id).'"]' ).'
					</div>';
	}
	else
	{
		$output .= '';
	}
	wp_reset_postdata();
	echo $output;
?>