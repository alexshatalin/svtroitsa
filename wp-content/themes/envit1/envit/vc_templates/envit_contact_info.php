<?php 
$atts = vc_map_get_attributes( 'envit_contact_info', $atts );
	extract( $atts );
	$output = '';

	$output .= '<div class="contact-info '.esc_attr($el_class).'">
						<h4 class="tt-featured-title font16">'.esc_attr($contact_heading).'</h4>
					 <div class="simple-text font16">
						<p>'.esc_attr($contact_sub_heading).'</p>
					 </div>
					 <div class="locationBlock">
						<i class="fa fa-map-marker"></i>
						<div class="locationContent">
							<p>'.esc_attr($add_title).'</p>
							<span>'.esc_attr($add_text_one).'<br>'.esc_attr($add_text_two).'</span>
						</div>
					 </div>
					 <div class="footerContants">
						<i class="fa fa-envelope-o"></i>
						<div class=" locationContent">
						 <p>'.esc_attr($eml_title).'</p>
						<a href="mailto:'.esc_attr($eml_text_one).'" class="mail">'.esc_attr($eml_text_one).'</a><br>
						<a href="mailto:'.esc_attr($eml_text_two).'" class="mail">'.esc_attr($eml_text_two).'</a>
							</div>
					 </div>
					 <div class="footerContants">
						<i class="fa fa-phone"></i>
						<div class=" locationContent">
						 <p>'.esc_attr($phn_title).'</p>
						<a href="tel:'.esc_attr($phn_no_one).'">'.esc_attr($phn_no_one).'</a><br>
						<a href="tel:'.esc_attr($phn_no_two).'">'.esc_attr($phn_no_two).'</a>
						</div>
					</div>
				</div>';	
echo $output;

?>