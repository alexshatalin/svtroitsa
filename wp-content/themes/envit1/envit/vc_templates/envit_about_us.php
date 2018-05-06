<?php 
$atts = vc_map_get_attributes( 'envit_about_us', $atts );
	extract( $atts );
	$output = '';
	if($background_image == '')	{
		$background_image = get_template_directory_uri() . '/assets/images/allmix/about_bg.jpg';
	}	else	{
		$background_image = wp_get_attachment_url( $background_image );
	}
	$backgroundImage = 'style=background-image:url('. esc_attr($background_image) .');';
	if($main_image == '')	{
		$main_image = get_template_directory_uri() . '/assets/images/allmix/about.jpg';
	}	else	{
		$main_image = wp_get_attachment_url( $main_image );
	}
	$mainImage = 'style=background-image:url('. esc_attr($main_image) .');';
	if($main_image1 == '')	{
		$main_image1 = get_template_directory_uri() . '/assets/images/allmix/about.jpg';
	}	else	{
		$main_image1 = wp_get_attachment_url( $main_image );
	}	
	if($first_sub_image != '')	{
		$first_sub_image = wp_get_attachment_url( $first_sub_image );
	}	else	{
		$first_sub_image = '';
	}
	if($second_sub_image != '')	{
		$second_sub_image = wp_get_attachment_url( $second_sub_image );
	}	else	{
		$second_sub_image = '';
	}
	if($third_sub_image != '')	{
		$third_sub_image = wp_get_attachment_url( $third_sub_image );
	}	else	{
		$third_sub_image = '';
	}
	$output .= '<div class="tt-image-row '. esc_attr($el_class).'" '.esc_attr($backgroundImage).'>
					<div class="container">
						<div class="tt-image-row-bg" '.esc_attr($mainImage).'>
							<img src="'.esc_attr($main_image1).'" alt="">
						</div>
						<div class="empty-space-sm-30"></div>
						<div class="row">
							<div class="col-md-7 col-md-offset-5">
								<h3 class="tt-title font28 white">'.esc_attr($about_heading).'</h3>
								<div class="empty-space-mb-30"></div>
								 <h4 class="tt-subtitle white text-left">'.esc_attr($about_sub_heading).'</h4>
								 <div class="text-decor1"></div>
								 <div class="empty-space-sm-30"></div>
								<div class="simple-text white">
									<p>'.esc_attr($about_description).'</p>
								</div>
								<div class="empty-space marg-lg-b50"></div>
								<div class="row">
									<div class="col-sm-4 col-md-4">
										<div class="tt-feature clearfix">
										<div class="image">
											<img class="tt-feature-img img-responsive" src="'.esc_attr($first_sub_image).'"  alt="">
											</div>
											<div class="text">
											<h3 class="tt-title white">'.esc_attr($first_number).'</h3>
											<h5>'.esc_attr($first_sub_heading).'</h5>
											</div>
										</div>
									</div>
									<div class="col-sm-4 col-md-4">
										<div class="tt-feature clearfix">
										<div class="image">
											<img class="tt-feature-img img-responsive" src="'.esc_attr($second_sub_image).'"  alt="">
											</div>
										   <div class="text">
											<h3 class="tt-title white">'.esc_attr($second_number).'</h3>
											<h5>'.esc_attr($second_sub_heading).'</h5>
											</div>
										</div>                                
									</div>
									<div class="col-sm-4 col-md-4">
										<div class="tt-feature">
										<div class="image">
											<img class="tt-feature-img img-responsive" src="'.esc_attr($third_sub_image).'"  alt="">
											</div>
										  <div class="text">
											<h3 class="tt-title white">'.esc_attr($third_number).'</h3>
											<h5>'.esc_attr($third_sub_heading).'</h5>
											</div>
										</div>
										<div class="empty-space marg-xs-b20"></div>
									</div>
								</div>					  
							</div>
						</div>
					</div>
				</div>';
echo $output;
?>