<?php
				$atts = vc_map_get_attributes( 'envit_helping', $atts );
					extract( $atts );
					$output .= '';
					$count  = 0;
					if($layout == 'layout_one')
					{
						$output .= '<h3 class="tt-title font-32">'.esc_attr($maintitle_heading).'</h3>
									<div class="simple-text">
										<p>'.esc_attr($content).'</p>
									</div>
									<ul>
										<li>'.esc_attr($textfield_one).'</li>
										<li>'.esc_attr($textfield_two).'</li>
										<li>'.esc_attr($textfield_three).'</li>
										<li>'.esc_attr($textfield_four).'</li>
									</ul>';
					}
					elseif($layout == 'layout_two')
					{
					$output .='<h4 class="tt-service-title">'.esc_attr($maintitle_heading).'</h4>
							   <div class="simple-text">
									<p>'.esc_attr($content).'</p>
							   </div>
							   <ul>
									<li>'.esc_attr($textfield_one).'</li>
									<li>'.esc_attr($textfield_two).'</li>
									<li>'.esc_attr($textfield_three).'</li>
									<li>'.esc_attr($textfield_four).'</li>
							   </ul>';
					}
					elseif($layout == 'layout_three')
					{
					$output .='<div class="simple-text">
								  <p>'.esc_attr($content).'</p>
							   </div>
							   <ul>
								  <li>'.esc_attr($textfield_one).'</li>
								  <li>'.esc_attr($textfield_two).'</li>
							   </ul>';
					}
	wp_reset_postdata();
	echo $output;
?>