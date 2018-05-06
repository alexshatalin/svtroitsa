<?php
	$atts = vc_map_get_attributes( 'envit_filter', $atts );
	extract ($atts);	
	$output = null;
	$output .= '<div class="responsiveFilter">
							<h6 class="h6 as light">'.esc_attr($fltr_title).'</h6>
							<i class="fa fa-angle-down"></i>
			 </div>';

	echo $output;
?>