<?php
	$atts = vc_map_get_attributes( 'envit_join_us', $atts );
	extract( $atts );
	$output .= '';
	$count  = 0;
	$href = vc_build_link( $buttonlink );
	$link = vc_build_link( $buttonlink2 );
	$output .= '<h3 class="tt-title font40 white text-center">'.esc_attr($maintitle_heading).' <span>'.esc_attr($maintitle_heading1).'</span></h3>
				<div class="empty-space-mb-20"></div>
				<h4 class="tt-subtitle font24 white text-center weight300">'.esc_attr($subtitle_heading).'</h4>
				<div class="empty-space-mb-10"></div>
				<div class="simple-text white font16 text-center">
					 <p>'.esc_attr($content).'</p>
				</div>	
				<div class="empty-space marg-lg-b50"></div>
				<div class="buttons">
					<a href="'.esc_url($href[url]).'" class="c-btn btn1">'.esc_attr($href[title]).'</a>
					<a href="'.esc_url($link[url]).'" class="c-btn btn2">'.esc_attr($link[title]).'</a>
				</div>';
	wp_reset_postdata();
	echo $output;
?>