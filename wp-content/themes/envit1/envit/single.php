<?php envit_get_header();
	while(have_posts()) 
	{
		the_post(); ?>
			<div class="blogdetails">
			<?php global $envit_option;
				if ( ! empty($envit_option['blog_sidebar_type'])) 
				{
					$sidebar_type = $envit_option['blog_sidebar_type'];	
				} 
				else 
				{
					$sidebar_type = 'wp';
				}
				if ( $sidebar_type == 'wp' && isset($envit_option['blog_wp_sidebar'])  ) 
				{	
					$sidebar_id = $envit_option['blog_wp_sidebar'];	
				} 
				else 
				{
						if(isset($envit_option['blog_vc_sidebar']))
						{
							$sidebar_id = $envit_option['blog_vc_sidebar'];
						}
				}
				if ( ! empty( $sidebar_id) ) 
				{
					 $sidebar_id =  $sidebar_id;	 
				} 
				else 
				{
					$sidebar_id = 'envit-right-sidebar';
				}
				if(! empty($envit_option['detail_sidebar_position'])) 
				{
					$sidebar_position = $envit_option['detail_sidebar_position'];
				} 
				else 
				{
					$sidebar_position = 'right';
				}
				$envit_layout = envit_get_structure( $sidebar_id, $sidebar_type, $sidebar_position);
				echo wp_kses_post($envit_layout['content_before']); ?>
				<div class="blogWrapper">
					<a class="tt-news-img imgWrapper">
						<?php
							if( has_post_thumbnail( ) ) 
							{
								the_post_thumbnail( 'blog-large', array('class' => 'img-responsive') );
							}
						?>
					</a>
					<?php if(isset($envit_option['blogdetail_metadata']) && $envit_option['blogdetail_metadata'] == '1')
							{ ?>
								<?php if(isset($envit_option['blogdetail_multi_checkbox']) && $envit_option['blogdetail_multi_checkbox']['date'] == '1')
								{ ?>
									<div class="date">
										<h5><?php echo get_the_date("d"); ?></h5>
										<span><?php echo get_the_date("M"); ?></span>
									</div>
					<?php 		}
							}
							$tags = wp_get_post_tags(get_the_ID(), array('fields' => 'names'));
							if(isset($envit_option['blogdetail_metadata']) && $envit_option['blogdetail_metadata'] == '1')
							{ ?>
								<div class="blogInfo borderTop">
									<?php if(isset($envit_option['blogdetail_multi_checkbox']) && $envit_option['blogdetail_multi_checkbox']['author'] == '1')
									{ ?>
										<p>
											<i class="fa fa-user"></i>
											<?php echo esc_html( 'By:', 'envit' ); ?> <?php the_author(); ?>
										</p>
							<?php 	}
									if(isset($envit_option['blogdetail_multi_checkbox']) && $envit_option['blogdetail_multi_checkbox']['tag'] == '1')
									{ 
										if(!empty($tags))
										{ ?>
											<p>
												<i class="fa fa-tag"></i>
										<?php 	foreach($tags as $postTags)
												{ ?>
													<a href="<?php echo get_the_permalink(); ?>" class="titleLink blogLnk">
														<?php echo esc_attr($postTags); ?>
													</a>
										<?php 	} ?>
											</p>
								<?php 	}
									}
									if(isset($envit_option['blogdetail_multi_checkbox']) && $envit_option['blogdetail_multi_checkbox']['comment'] == '1')
									{ ?>
										<p>
											<i class="fa fa-comments-o"></i>
											<?php echo esc_html( 'Comments:', 'envit' ); ?> 
											<span>
												<?php echo get_comments_number(get_the_ID()); ?>
											</span>
										</p>
							<?php 	} ?>
								</div>
					<?php 	}
							else
							{ ?>
								<div class="blogInfo borderTop">
									<p>
										<i class="fa fa-user"></i>
										<?php echo esc_html( 'By:', 'envit' ); ?> <?php the_author(); ?>
									</p>
									 
							<?php if(!empty($tags))
									{ ?>
										<p>
											<i class="fa fa-tag"></i>
									<?php 	foreach($tags as $postTags)
											{ ?>
												<a href="<?php echo get_the_permalink(); ?>" class="titleLink blogLnk">
													<?php echo esc_attr($postTags); ?>
												</a>
									<?php 	} ?>
										</p>
							<?php 	} ?>
									<p>
										<i class="fa fa-comments-o"></i>
										<?php echo esc_html( 'Comments:', 'envit' ); ?> 
										<span>
											<?php echo get_comments_number(get_the_ID()); ?>
										</span>
									</p>
								</div>
					<?php 	}
						the_content(); 
						wp_link_pages( array(
							'before'      => '<div class="page-links"><label>' . esc_html__( 'Pages:', 'envit' ) . '</label>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '%',
							'separator'   => '',
						) );
					if (  class_exists( 'Redux' ) ) 
					{   
						if(isset($envit_option['switch_comments']) && $envit_option['switch_comments'] == 1 ) 
						{ 
							if ( comments_open() || get_comments_number() ) 
							{ ?>
								<div class="commentsForm">
									<?php comments_template(); ?>
								</div>
					<?php	} 
						} 
					} 
					else 
					{
						if ( comments_open() || get_comments_number() ) 
						{ ?>
							<div class="commentsForm">
								<?php comments_template(); ?>
							</div>
				<?php	} 
					} ?>
				</div>
			<?php 	echo wp_kses_post($envit_layout['content_after']); 
					echo wp_kses_post($envit_layout['sidebar_before']);
					if ( $sidebar_id ) 
					{
						if ( $sidebar_type == 'wp' ) 
						{
							$sidebar = true;
						} 
						else 
						{
							$sidebar = get_post( $sidebar_id );
						}
					}
					if ( isset( $sidebar ) ) 
					{
						if ( $sidebar_type == 'vc' ) 
						{ ?>
							<div class="sidebar-area envit_sidebar">
								<?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
							</div>
				<?php 	} 
						else 
						{
							if( is_active_sidebar( $sidebar_id ) )
							{ ?>
								<div class="mobileSearch large">
									<?php echo esc_attr('Sidebar','envit'); ?>
									<i class="fa fa-angle-down"></i>
								</div>
								<aside class="blogAside">
									<?php dynamic_sidebar( $sidebar_id ); ?>
								</aside>
					<?php 	}
						}
					}
					echo wp_kses_post($envit_layout['sidebar_after']); ?>
			</div> <!-- #post-## -->		
<?php 
	}
get_footer(); ?>